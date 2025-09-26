<?php

Route::get('/phpinfo', function () {
    echo phpinfo();
    exit;
});

Route::get('/emailtest', function () {
    $EmailTemplate = App\Models\EmailTemplates::find(2);
    if (! empty($EmailTemplate)) {
        // MODIFT TEMPLATE
        $ToArray = ['[NAME]'];
        $ReplaceArray = ['dfgdfg'];
        $EmailTemplate->v_template_body = str_replace($ToArray, $ReplaceArray, $EmailTemplate->v_template_body);

        // SEND EMAIL
        App\Helpers\MailSendHelper::send_email('11', '', $EmailTemplate, ['sandeepgajeradeveloper1@gmail.com'], []);
    }
});

Route::get('/mail-read-imap', function () {
    ?>

    <table class="table table-striped table-hover">
    <tbody>
        <tr class="warning">
            <td class="inbox-small-cells">
            <input type="checkbox" class="mail-checkbox">
            </td>
            <td ><i class="fa fa-star"></i></td>
            <td >#</td>
            <td >Sender</td>
            <td >Subject</td>
            <td ><i class="fa fa-paperclip"></i></td>
            <td >Date</td>  
            <td >Message</td>
        </tr>
    <?php
    $mailbox = '{imap.gmail.com:993/imap/ssl}INBOX';
    $username = 'harshit.kakadiya1996@gmail.com';
    $password = 'tuedkwrgjovxolpv';

    $connection = imap_open($mailbox, $username, $password);

    if ($connection) {
        $emails = imap_search($connection, 'UNSEEN');

        /*foreach ($emails as $emailId)
        {
            $emailData = imap_fetchbody($connection, $emailId, 1);
            // Process email data
        }*/

        if ($emails) {
            rsort($emails);
            /* for every email... */
            foreach ($emails as $email_number) {
                //$email_number=$emails[0];
                //print_r($emails);
                /* get information specific to this email */
                $overview = imap_fetch_overview($connection, $email_number, 0);
                imap_fetchbody($connection, $email_number, 1);

                $email_number;
                $overview[0]->subject;
                $overview[0]->from;
                $overview[0]->date;
                $overview[0]->size;
                ?>
                <tr class="text-info" >
                    <td class="inbox-small-cells" >
                    <input type="checkbox" class="mail-checkbox">
                    </td>
                    <td ><i class="fa fa-star"></i></td>
                    <td> <?php echo $email_number; ?></td>
                    <td ><?php echo $overview[0]->from;?></a></td>
                    <td><?php echo $overview[0]->subject; ?></td>
                    <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                    <td ><?php echo $overview[0]->date; ?> </td>
                </tr>
        <?php
            }
        }

        ?>
                </tbody>
            </table>
        <?php
        /*print_r($emails);exit;

        imap_fetch_overview($mailbox,"$latest_uid:*", FT_UID); */

        echo '11';
        exit;
        // Connection successful
        // Perform operations on the mailbox
    }
    echo 'fail';
    exit;
    // Connection failed
    // Handle error

    $emails = imap_search($connection, 'ALL');

    foreach ($emails as $emailId) {
        imap_fetchbody($connection, $emailId, 1);
        // Process email data
    }

    imap_search($connection, 'SUBJECT "Hello World"');

    imap_delete($connection, $emailId);
    imap_expunge($connection);

    exit;

    /*// Create PhpImap\Mailbox instance for all further actions
    $mailbox = new PhpImap\Mailbox(
        '{imap.zoho.com:993/imap/ssl/}INBOX', // IMAP server and mailbox folder
        'awshelp@serverkaka.com', // Username for the before configured mailbox
        'Init@123', // Password for the before configured username
        __DIR__, // Directory, where attachments will be saved (optional)
        'UTF-8', // Server encoding (optional)
        true, // Trim leading/ending whitespaces of IMAP path (optional)
        false // Attachment filename mode (optional; false = random filename; true = original filename)
    );*/

    // Create PhpImap\Mailbox instance for all further actions
    $mailbox = new PhpImap\Mailbox(
        '{imap.gmail.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
        'harshit.kakadiya1996@gmail.com', // Username for the before configured mailbox
        'tuedkwrgjovxolpv', // Password for the before configured username
        __DIR__, // Directory, where attachments will be saved (optional)
        'UTF-8', // Server encoding (optional)
        true, // Trim leading/ending whitespaces of IMAP path (optional)
        false // Attachment filename mode (optional; false = random filename; true = original filename)
    );

    // set some connection arguments (if appropriate)
    $mailbox->setConnectionArgs(
        CL_EXPUNGE // expunge deleted mails upon mailbox close
        | OP_SECURE // don't do non-secure authentication
    );

    try {
        // Get all emails (messages)
        // PHP.net imap_search criteria: http://php.net/manual/en/function.imap-search.php
        $mailsIds = $mailbox->searchMailbox('ALL');
        //$mails = imap_search($stream, 'UNSEEN');
    } catch(PhpImap\Exceptions\ConnectionException $ex) {
        echo 'IMAP connection failed: ' . implode(',', $ex->getErrors('all'));
        die;
    }

    // If $mailsIds is empty, no emails could be found
    if (! $mailsIds) {
        die('Mailbox is empty');
    }

    // Get the first message
    // If '__DIR__' was defined in the first line, it will automatically
    // save all attachments to the specified directory
    $mail = $mailbox->getMail($mailsIds[0]);

    // Show, if $mail has one or more attachments
    echo "\nMail has attachments? ";
    if ($mail->hasAttachments()) {
        echo "Yes\n";
    } else {
        echo "No\n";
    }

    // Print all information of $mail
    print_r($mail);

    // Print all attachements of $mail
    echo "\n\nAttachments:\n";
    print_r($mail->getAttachments());
});
