// // Timer Start
// document.addEventListener('DOMContentLoaded', function() {
//     let time = 1188; // 19 minutes and 48 seconds in total seconds
//     const totalTime = time; // Store the initial time to calculate the progress

//     const circle = document.querySelector('.progress-ring__circle');
//     const radius = circle.r.baseVal.value;
//     const circumference = 2 * Math.PI * radius;

//     circle.style.strokeDasharray = `${circumference} ${circumference}`;
//     circle.style.strokeDashoffset = circumference;

//     function setProgress(percent) {
//         const offset = circumference - percent / 100 * circumference;
//         circle.style.strokeDashoffset = offset;
//     }

//     function updateTime() {
//         const minutes = Math.floor(time / 60);
//         const seconds = time % 60;
//         document.getElementById('time').innerText = `${minutes} : ${seconds < 10 ? '0' + seconds : seconds}`;
//         const percent = (time / totalTime) * 100;
//         setProgress(percent);
//     }

//     function countdown() {
//         if (time > 0) {
//             time--;
//             updateTime();
//         }
//     }

//     setInterval(countdown, 1000);

//     document.querySelector('.btn-add-time').addEventListener('click', function() {
//         time += 120; // Add 2 minutes (120 seconds)
//         updateTime();
//     });

//     updateTime();
// });

// // Timer Js End

// // Slide Button Start

// $(function () {
//     $('button')
//       .bind('mousedown', function () {
//         if ($(this).attr('disabled')) return !1;
//         return $.data(this, 'sliding', 1), !1;
//       })
//       .bind('mouseup mouseleave', function (e) {
//         e.preventDefault();

//         if ($.data(this, 'sliding')) {
//           $.data(this, 'sliding', 0);

//           var pct = (parseInt($(this).find('> confirm').css('right')) / $(this).outerWidth() * 100);

//           if (pct <= 25)
//             $(this).find('> confirm').animate({ right: '4px' }, 500, 'easeOutSine', function () {
//               $(this).closest('button').trigger('change').attr('disabled', !0);
//             });
//           else
//             $(this).find('> confirm').animate({ right: '100%' }, 500, 'easeOutBounce');
//         }

//         return false;
//       })
//       .bind('mousemove', function (e) {
//         var sliding = $.data(this, 'sliding') ? !0 : !1,
//           pos;

//         if (sliding) {
//           pos = (e.pageX - $(this).offset().left) / $(this).outerWidth() * 100;
//           $(this).find('> confirm').css('right', (100 - pos) + '%');
//         }
//       });
//   });

//   // Slide Button End

