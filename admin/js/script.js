$(document).ready(function () {
  $("#summernote").summernote({
    height: 200,
  });
});

// $(document).ready(function () {
//   $("#selectAllBoxesDraft").click(function (e) {
//     if (this.checked) {
//       $(".checkBoxes").each(function () {
//         this.checked = true;
//       });
//     } else {
//       $(".checkBoxes").each(function () {
//         this.checked = false;
//       });
//     }
//   });
// });

// function loadUsersOnline() {
//   $.get("functions.php?onlineusers=result", function (data) {
//     $(".usersonline").text(data);
//   });
// }

// setInterval(function () {
//   loadUsersOnline();
// }, 500); // 0.5 sec
