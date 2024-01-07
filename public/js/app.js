const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})

$(document).ready(function () {
  $('.chosen-container').addClass('w-100')
  $('.chosen-choices').addClass('form-control')
  $('.chosen-choices').addClass('py-1')
});

// $(document).on('submit', '#addStudentModal', function (e) { 
//   e.preventDefault()
//   var formData = new FormData(this);
  
//   $.ajax({
//     type: "method",
//     url: "/",
//     data: formData,
//     contentType: false,
//     processData: false,
//     success: function (response) {
//       alert('test')
//     }
//   });
// })


const setTeacher = (data) => {
  let id = data['id'];
  let name = data['name'];

  $('#selectedStudentID').val(id);
  $('#selectedStudent').val(name);
}

$("#studentTable").DataTable({
  responsive: true, // Enable responsiveness
  lengthMenu: [5, 10],
  pageLength: 10,
  // dom: '<"custom-toolbar">Blfrtip', // Add Buttons extension to the DataTable
  // buttons: [
  //   {
  //     extend: "excel",
  //     title: null,  // Set title to null to remove it
  //     exportOptions: {
  //       columns: "thead th:not(.exclude)",
  //     },
  //   },
  // ],
  // initComplete: function () {
  //   $(".dt-buttons").addClass("text-end mb-2");
  //   $(".buttons-excel").addClass("btn btn-primary btn-sm");
  // }
});

$("#studentTableTeacherAccount").DataTable({
  responsive: true, // Enable responsiveness
  lengthMenu: [5, 10],
  pageLength: 10,
  dom: '<"custom-toolbar">Blfrtip', // Add Buttons extension to the DataTable
  buttons: [
    {
      extend: "excel",
      title: null,  // Set title to null to remove it
      exportOptions: {
        columns: "thead th:not(.exclude)",
      },
    },
  ],
  initComplete: function () {
    $(".dt-buttons span").text("Export Class List Data");
    $(".buttons-excel").addClass("btn btn-warning btn-sm mb-3");
  }
});

$("#teacherTable").DataTable({
  responsive: true, // Enable responsiveness
  lengthMenu: [5, 10],
  pageLength: 10,
  // dom: '<"custom-toolbar">Blfrtip', // Add Buttons extension to the DataTable
  // buttons: [
  //   {
  //     extend: "excel",
  //     title: "List of Record",
  //     exportOptions: {
  //       columns: "thead th:not(.exclude)",
  //     },
  //   }
  // ],
  // initComplete: function () {
  //   $(".dt-buttons").addClass("text-end mb-2");
  //   $(".buttons-excel").addClass("btn btn-primary btn-sm");
  // }
});


var ctx = $('#myChart')[0].getContext('2d');

$.ajax({
  type: "POST",
  url: "/getPie",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  success: function (response) {
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['PASS', 'FAILED'],
        datasets: [{
          label: 'Grade Report',
          data: [response.pass_count,response.failed_count],
          borderWidth: 1
        }]
      },
      options: {
      }
    });
  }
});

