<?php

namespace App\Http\Controllers\User;

use App\Models\UserEventParticipants;
use App\Models\UserEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;
use Rogersxd\VCard\VCard;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends BaseController
{
    public $page_name = 'User Event Step';
    public $view_folder = VIEW_FOLDER_USER;

    /*
       @Description: Function for Check Event Name Exists Or Not
       @Author: Sandeep Gajera
       @Input: Request
       @Output: - Check Event Exists Or Not Return In Response
       @Date: 05-08-2024
    */
    public function check_event_name(Request $request)
    {
        $is_user_logged_in = Auth::guard(GUARD_USER)->check();
        //TOTAL RUNNING EVENT AT A TIME VALIDATION LOGIC START
        $total_event_running_at_a_time = getSettings('total_event_running_at_a_time');
        if ($total_event_running_at_a_time > 0) {
            $total_system_running_event = UserEvents::where('e_is_remove_data', 'No')->count();
            if ($total_system_running_event > $total_event_running_at_a_time) {
                return response()->json(['flag' => false, 'is_user_logged_in' => $is_user_logged_in, 'msg' => str_replace('#TOTAL_RUNNING_EVENT_AT_TIME#', $total_event_running_at_a_time, MSG_FOR_EVENT_ALREADY_RUNNING_THEN_LIMIT_NOT_ALLOW)]);
            }
        }
        //TOTAL RUNNING EVENT AT A TIME VALIDATION LOGIC END

        $event_detail = UserEvents::where('v_email', '=', $request->get('v_event_name'))->where('e_is_remove_data', 'No')->first();
        if (empty($event_detail)) {
            if (UserEvents::where('v_email', $request->get('v_event_name'))->count() === 0) {
                return response()->json(['flag' => true, 'is_user_logged_in' => $is_user_logged_in, 'msg' => MSG_FOR_EVENT_NAME_NOT_EXISTS]);
            }

            return response()->json(['flag' => false, 'is_user_logged_in' => $is_user_logged_in, 'msg' => MSG_FOR_EVENT_ALREADY_REGIATER_WITH_SAME_NAME]);
        }

        return response()->json(['flag' => false, 'is_user_logged_in' => $is_user_logged_in, 'msg' => MSG_FOR_SOME_PROCESS_RUNNING_WITH_EVENT]);
    }

    /*
        @Description: Function for Create Event
        @Author: Sandeep Gajera
        @Input: Request
        @Output: - Create Event
        @Date: 25-06-2023
    */
    public function create_event(Request $request)
    {
        $user_detail = \Auth::guard(GUARD_USER)->user();
        $user_event = UserEvents::where('i_user_id', '=', $user_detail->id)->where('e_is_remove_data', 'No')->orderBy('created_at', 'desc')->first();
        if (empty($user_event)) {
            if (UserEvents::where('v_email', $request->get('v_event_name'))->count() === 0) {
                $user_event = new UserEvents();
                $user_event->v_email = $request->get('v_event_name');

                if ($request->has('v_latitude')) {
                    $user_event->v_latitude = $request->get('v_latitude');
                }

                if ($request->has('v_longitude')) {
                    $user_event->v_longitude = $request->get('v_longitude');
                }

                $user_event->v_email = $request->get('v_event_name');

                $user_event->i_user_id = $user_detail->id;
                $user_event->v_event_unique_id = mt_rand(100000, 999999);
                $user_event->i_event_contact_share_total_time_in_seconds = intval($request->get('i_event_contact_share_total_time_in_seconds', getSettings('event_contact_share_total_time_in_seconds')));
                $user_event->e_status = UserEvents::STATUS_ACTIVE;




                $fileName = Str::slug($request->get('v_event_name')) . '.svg';
                $path = "qrcodes/{$fileName}";
                $qrDir = storage_path('app/public/qrcodes');

                if (!File::exists($qrDir)) {
                    File::makeDirectory($qrDir, 0755, true); // true = recursive
                }
                $fullPath = storage_path("app/public/{$path}");

                $email =  $request->get('v_event_name') . '@' . getSettings('event_email_domain_name');
                $mailtoUrl = 'mailto:' . $email;

                // Generate QR code as raw image data using simple-qrcode
                $imageData = QrCode::format('svg')->size(300)->generate($mailtoUrl);

                // Save it to a file manually
                File::put($fullPath, $imageData);

                // Store the relative path
                $user_event->qr_code_path = $path;

                if ($user_event->save()) {
                    $user_event->i_event_contact_share_remaning_time_in_seconds = $user_event->i_event_contact_share_total_time_in_seconds;
                    $user_event->e_is_event_completed = 'No';

                    session([
                        'event_start' => true,
                        'event_time' => intval($request->get('i_event_contact_share_total_time_in_seconds', getSettings('event_contact_share_total_time_in_seconds'))),
                    ]);


                    return response()->json(['flag' => true, 'data' => $user_event, 'msg' => MSG_FOR_EVENT_SHARING_START]);
                }

                return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_SOME_ERROR]);
            }

            return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_EVENT_ALREADY_REGIATER_WITH_SAME_NAME]);
        }
        if (! empty($user_event->created_at)) {
            if (empty($user_event->getRawOriginal('d_event_sharing_completed_datetime'))) {
                // Create DateTime objects for the created_at timestamp and the cur)rent time
                $created_at = new \DateTime($user_event->created_at, new \DateTimeZone('UTC'));
                $now = new \DateTime('now', new \DateTimeZone('UTC'));

                // Calculate the difference between the two DateTime objects
                $interval = $now->diff($created_at);

                // Convert the difference to seconds
                $second_time = ($interval->days * 24 * 60 * 60) // Convert days to seconds
                    + ($interval->h * 60 * 60) // Convert hours to seconds
                    + ($interval->i * 60) // Convert minutes to seconds
                    + $interval->s; // Add seconds

                $second_diffrence = (int) $user_event->i_event_contact_share_total_time_in_seconds - $second_time;
                if ((int) $second_diffrence <= 0) {
                    // Create a DateInterval object representing the number of seconds to add
                    $interval = new \DateInterval('PT' . $user_event->i_event_contact_share_total_time_in_seconds . 'S');
                    $user_event->d_event_sharing_completed_datetime = $created_at->add($interval)->format(DATABASE_STORE_DATE_TIME_FORMAT);
                    $user_event->save();

                    $user_event->e_is_event_completed = 'Yes';
                } else {
                    $user_event->e_is_event_completed = 'No';
                    $user_event->i_event_contact_share_remaning_time_in_seconds = $second_diffrence;
                }
            } else {
                $user_event->e_is_event_completed = 'Yes';
                $user_event->i_event_contact_share_remaning_time_in_seconds = 0;
            }

            if ($user_event->e_is_remove_data === 'Yes' && $user_event->e_is_event_completed === 'Yes') {
                return response()->json(['flag' => false, 'data' => $user_event, 'msg' => '']);
            }
            if ($user_event->e_is_remove_data === 'No' && $user_event->e_is_event_completed === 'No') {
                $msg = MSG_FOR_SOME_PROCESS_RUNNING_WITH_EVENT;
            } elseif ($user_event->e_is_remove_data === 'No' && $user_event->e_is_event_completed === 'Yes') {
                $msg = '';
                //$msg = MSG_FOR_SOME_PROCESS_RUNNING_WITH_EVENT;
            }
            return response()->json(['flag' => false, 'data' => $user_event, 'msg' => $msg]);
        }
    }

    /*
        @Description: Function for Completed Event By User
        @Author: Sandeep Gajera
        @Input: Request
        @Output: - Completed Event Success Msg
        @Date: 25-07-2023
    */
    public function completed_event(Request $request)
    {
        $user_detail = \Auth::guard(GUARD_USER)->user();
        if (! empty($request->get('v_event_name'))) {
            //IF STOP EVENT THEN CODE BELOW START
            UserEvents::where('i_user_id', '=', $user_detail->id)->where('v_email', $request->get('v_event_name'))->update(['d_event_sharing_completed_datetime' => CURRENT_DATE_TIME, 'e_status' => UserEvents::STATUS_COMPLETED]);
            $userEvent = UserEvents::where('i_user_id', '=', $user_detail->id)->orderBy('created_at', 'desc')->first();
            //IF STOP EVENT THEN CODE BELOW END
            return response()->json(['flag' => true, 'data' => $userEvent, 'msg' => MSG_FOR_EVENT_COMPLETED_SUCCESSFULLY_BY_USER]);
        }
    }

    /*
        @Description: Function for Share Email
        @Author: Sandeep Gajera
        @Input: Request
        @Output: - Update Event Status
        @Date: 25-06-2023
    */
    public function share_email(Request $request)
    {
        $user_detail = \Auth::guard(GUARD_USER)->user();

        $event_detail = UserEvents::where('i_user_id', $user_detail->id)->where('id', $request->get('i_user_event_id'))->where('e_is_remove_data', 'No')->orderBy('id', 'asc')->first();

        if (! empty($event_detail)) {
            date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));
            $event_detail->e_status = UserEvents::STATUS_COMPLETED;
            $event_detail->d_event_sharing_completed_datetime = date('Y-m-d H:i:s');
            $event_detail->save();
            return response()->json(['flag' => true, 'data' => '', 'msg' => MSG_FOR_EVENT_STATUS_UPDATE]);
        }

        return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_EVENT_NOT_FOUND]);
    }

    /*
        @Description: Function for Event Email Received
        @Author: Sandeep Gajera
        @Input:
        @Output: - Sent Event Email Received
        @Date: 25-06-2023
    */
    public function event_share_email_received(Request $request)
    {
        if ($request->has('i_user_event_id')) {
            $user_detail = \Auth::guard(GUARD_USER)->user();
            if (UserEvents::where('i_user_id', '=', $user_detail->id)->where('id', $request->i_user_event_id)->count()) {
                $total_event_user_participant = UserEventParticipants::where('i_user_event_id', $request->i_user_event_id)->count();
                return response()->json(['flag' => true, 'data' => $total_event_user_participant, 'msg' => 'User event participant found']);
            }
            // return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_INVALID_EVENT_ID]);
        }

        return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_NOT_PASS_USER_EVENT_ID]);
    }

    /*
        @Description: Function for Event Share Email Add Time
        @Author: Sandeep Gajera
        @Input:
        @Output: - Update Time For Email Share
        @Date: 25-06-2023
    */
    public function event_share_email_addon_time(Request $request)
    {
        if ($request->has('i_user_event_id')) {
            $user_detail = \Auth::guard(GUARD_USER)->user();
            UserEvents::where('i_user_id', '=', $user_detail->id)->where('id', $request->i_user_event_id)->increment('i_event_contact_share_total_time_in_seconds', getSettings('event_addon_timer_in_seconds'));
            return response()->json(['flag' => true, 'msg' => MSG_FOR_USER_EVENT_SHARE_TIME_UPDATE]);
        }

        return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_NOT_PASS_USER_EVENT_ID]);
    }

    /*
        @Description: Function for Event Content Check And Delete
        @Author: Sandeep Gajera
        @Input: Request
        @Output: - Event Content Delete
        @Date: 25-06-2023
    */
    public function event_content_check_delete(Request $request)
    {
        if ($request->has('i_user_event_id')) {
            $user_detail = \Auth::guard(GUARD_USER)->user();
            $event_detail = UserEvents::where('i_user_id', '=', $user_detail->id)->where('id', $request->i_user_event_id)->first();
            if (! empty($event_detail)) {
                if ($event_detail->e_is_remove_data === 'Yes') {
                    return response()->json(['flag' => true, 'msg' => MSG_FOR_USER_EVENT_CONTACT_DELETE_SUCCESS]);
                }

                return response()->json(['flag' => false, 'msg' => MSG_FOR_USER_EVENT_DELETE_CONTECT_PROCESS_IN_RUNNING_STATE]);
            }

            return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_NOT_PASS_USER_EVENT_ID]);
        }

        return response()->json(['flag' => false, 'data' => '', 'msg' => MSG_FOR_NOT_PASS_USER_EVENT_ID]);
    }

    public function check_event(Request $request)
    {
        $user = \Auth::guard(GUARD_USER)->user();
        $user_event = UserEvents::where('i_user_id', $user->id)
            ->where('e_is_remove_data', 'No')
            ->first();
        if (! empty($user_event->created_at)) {
            if (empty($user_event->d_event_sharing_completed_datetime)) {
                $created_at = new \DateTime($user_event->created_at, new \DateTimeZone('UTC'));
                $now = new \DateTime('now', new \DateTimeZone('UTC'));

                $interval = $now->diff($created_at);

                $second_time = ($interval->days * 24 * 60 * 60)
                    + ($interval->h * 60 * 60)
                    + ($interval->i * 60)
                    + $interval->s;

                $second_diffrence = (int) $user_event->i_event_contact_share_total_time_in_seconds - $second_time;

                if ((int) $second_diffrence <= 0) {
                    $interval = new \DateInterval('PT' . $user_event->i_event_contact_share_total_time_in_seconds . 'S');
                    $user_event->d_event_sharing_completed_datetime = $created_at->add($interval)->format(DATABASE_STORE_DATE_TIME_FORMAT);
                    $user_event->save();

                    $user_event->e_is_event_completed = 'Yes';
                } else {
                    $user_event->e_is_event_completed = 'No';
                    $user_event->i_event_contact_share_remaning_time_in_seconds = $second_diffrence;
                }
            } else {
                $user_event->e_is_event_completed = 'Yes';
                $user_event->i_event_contact_share_remaning_time_in_seconds = 0;
            }

            if ($user_event->e_is_remove_data === 'Yes' && $user_event->e_is_event_completed === 'Yes') {
                return response()->json(['flag' => false, 'data' => $user_event, 'msg' => '']);
            }
            if ($user_event->e_is_remove_data === 'No' && $user_event->e_is_event_completed === 'No') {
                $msg = MSG_FOR_SOME_PROCESS_RUNNING_WITH_EVENT;
            } elseif ($user_event->e_is_remove_data === 'No' && $user_event->e_is_event_completed === 'Yes') {
                $msg = '';
            }
            return response()->json(['flag' => false, 'data' => $user_event, 'msg' => $msg]);
        } else {
            return response()->json(['flag' => false, 'data' => '', 'is_user_logged_in' => Auth::check(), 'msg' => '']);
        }
    }

    public function check_redirect(Request $request)
    {
        if (Auth::guard(GUARD_USER)->check()) {
            session('redirect_to_value', 'step-4-pobox51');
        } else {
            session('redirect_to_value', 'step-3-pobox51');
        }
    }

    public function generate(Request $request)
    {
        $email = Str::random(8) . '@yourdomain.com';
        $url = url('/mailbox?email=' . urlencode($email));

        $fileName = Str::slug($email) . '.png';
        $path = "qrcodes/{$fileName}";
        $fullPath = storage_path("app/public/{$path}");

        // Generate and save QR code image
        QrCode::format('png')->size(300)->generate($url, $fullPath);

        // Save in DB
        $record = TemporaryEmail::create([
            'email' => $email,
            'qr_code_path' => $path
        ]);

        return view('show-qr', compact('record'));
    }

    public function getEventTime($eventId)
    {
        $event = UserEvents::where('id', $eventId)->first();
        return response()->json(['flag' => true, 'data' => $event, 'msg' => 'Event time fetched successfully']);
    }

    public function downloadVcf($eventId)
    {
        $event = UserEvents::with(['user_event_participants' => function ($query) {
            $query->orderBy('id', 'asc');
            if (getSettings('event_max_number_of_participant') > 0) {
                $query->take(getSettings('event_max_number_of_participant'));
            }
        }])->findOrFail($eventId);

        $vcfFileName = $event->v_email . '.vcf';
        $mobileVcfPath = MOBILE_NUMBER_VCF_FILE_PATH . $vcfFileName;
        $nonMobileVcfPath = NON_MOBILE_NUMBER_VCF_FILE_PATH . $vcfFileName;

        // Clean up old files if they exist
        if (file_exists($mobileVcfPath)) unlink($mobileVcfPath);
        if (file_exists($nonMobileVcfPath)) unlink($nonMobileVcfPath);

        // Create directories if they don't exist
        if (!file_exists(MOBILE_NUMBER_VCF_FILE_PATH)) {
            mkdir(MOBILE_NUMBER_VCF_FILE_PATH, 0755, true);
        }
        if (!file_exists(NON_MOBILE_NUMBER_VCF_FILE_PATH)) {
            mkdir(NON_MOBILE_NUMBER_VCF_FILE_PATH, 0755, true);
        }

        $eventDateTime = 'DATE-TIME:' . date(CURRENT_DATE_TIME_FORMAT, strtotime($event->created_at));
        $eventName = 'EVENT-NAME:' . $event->v_email;

        try {
            // Filter for unique email participants only
            $uniqueEmailParticipants = $event->user_event_participants->unique('v_email');

            // Create combined VCard content for unique email participants
            $combinedMobileVCardContent = '';
            $combinedNonMobileVCardContent = '';

            // Process participants with unique emails
            foreach ($uniqueEmailParticipants as $participant) {
                $vcard = new VCard();

                // Add participant name
                $vcard->addNames($participant->v_name);

                // Add notes with event information
                $notesData = 'ORGANISER-NAME: ' . $participant->v_name . ' ' . $eventName . ' ' . $eventDateTime;
                $vcard->addNote($notesData);

                // Add email if exists
                if (!empty($participant->v_email)) {
                    $vcard->addEmail($participant->v_email);
                }

                // Save to appropriate file based on phone number
                if (!empty($participant->v_phone_number)) {
                    $vcard->addPhone($participant->v_phone_number, 'CELL');

                    // Save to temporary file and read its content for mobile contacts
                    $tempMobileFileName = 'temp_mobile_download_' . $participant->id . '_' . time() . '_' . rand(1000, 9999);
                    $vcard->setFilename($tempMobileFileName);
                    $vcard->setSavePath(MOBILE_NUMBER_VCF_FILE_PATH);
                    $vcard->save();

                    // Read the temporary file content
                    $tempMobileFilePath = MOBILE_NUMBER_VCF_FILE_PATH . $tempMobileFileName . '.vcf';
                    if (file_exists($tempMobileFilePath)) {
                        $combinedMobileVCardContent .= file_get_contents($tempMobileFilePath);
                        // Delete the temporary file
                        unlink($tempMobileFilePath);
                    }
                } else {
                    // Save to temporary file and read its content for non-mobile contacts
                    $tempNonMobileFileName = 'temp_non_mobile_download_' . $participant->id . '_' . time() . '_' . rand(1000, 9999);
                    $vcard->setFilename($tempNonMobileFileName);
                    $vcard->setSavePath(NON_MOBILE_NUMBER_VCF_FILE_PATH);
                    $vcard->save();

                    // Read the temporary file content
                    $tempNonMobileFilePath = NON_MOBILE_NUMBER_VCF_FILE_PATH . $tempNonMobileFileName . '.vcf';
                    if (file_exists($tempNonMobileFilePath)) {
                        $combinedNonMobileVCardContent .= file_get_contents($tempNonMobileFilePath);
                        // Delete the temporary file
                        unlink($tempNonMobileFilePath);
                    }
                }
            }

            // Save combined content to final files
            if (!empty($combinedMobileVCardContent)) {
                file_put_contents($mobileVcfPath, $combinedMobileVCardContent);
            }
            if (!empty($combinedNonMobileVCardContent)) {
                file_put_contents($nonMobileVcfPath, $combinedNonMobileVCardContent);
            }

            // Determine which file to download (prefer mobile version if it exists and has content)
            $downloadPath = null;

            // Check if mobile VCF file exists and has content
            if (file_exists($mobileVcfPath) && filesize($mobileVcfPath) > 0) {
                $downloadPath = $mobileVcfPath;
            }
            // Otherwise check non-mobile VCF file
            elseif (file_exists($nonMobileVcfPath) && filesize($nonMobileVcfPath) > 0) {
                $downloadPath = $nonMobileVcfPath;
            }

            if (!$downloadPath || !file_exists($downloadPath) || filesize($downloadPath) === 0) {
                return response()->json(['error' => 'VCF file not found or empty. No participants with unique emails found.'], 404);
            }

            return response()->download($downloadPath, $vcfFileName, [
                'Content-Type' => 'text/x-vcard',
                'Content-Disposition' => 'attachment; filename="' . $vcfFileName . '"',
            ]);
        } catch (\Exception $e) {
            // Clean up in case of error
            if (file_exists($mobileVcfPath)) unlink($mobileVcfPath);
            if (file_exists($nonMobileVcfPath)) unlink($nonMobileVcfPath);
            throw $e;
        }
    }

    public function check_running_event(Request $request)
    {
        $user = Auth::guard(GUARD_USER)->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'user_logged_in' => false,
                'user_event_id' => null
            ]);
        }
        $event = UserEvents::where('i_user_id', $user->id)
            ->where('e_is_remove_data', 'No')
            ->first();
        if(empty($event)){
            return response()->json([
            'status' =>  false,
            'user_logged_in' =>  $user ? true : false,
            'user_event_id' => null
        ]);
        }
        return response()->json([
            'status' => $event ? true : false,
            'user_event_id' => $event->id,
            'user_logged_in' => $user ? true : false,
            'data' => $event
        ]);
    }
}
