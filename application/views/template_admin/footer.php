 <footer class="footer py-4  ">
     <div class="container-fluid">
         <div class="row align-items-center justify-content-lg-between">
             <div class="col-lg-12 mb-lg-0 mb-4">
                 <div class="copyright text-center text-sm text-muted text-lg-center">
                     © <script>
                         document.write(new Date().getFullYear())
                     </script>,
                     made with <i class="fa fa-heart"></i> by
                     <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">XG Systech</a>
                 </div>
             </div>

         </div>
     </div>
 </footer>
 </div>
 </main>
 <!-- ===============================
JQUERY (HARUS PALING ATAS)
=============================== -->
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"
     integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
     crossorigin="anonymous"></script>

 <!-- BOOTSTRAP -->
 <script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js"></script>

 <!-- PLUGINS -->
 <script src="<?= base_url(); ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/plugins/chartjs.min.js"></script>

 <!-- SWEETALERT -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <?php if (!empty($is_dashboard)): ?>

     <script>
         const chartBars = document.getElementById("chart-bars");
         if (chartBars) {
             const ctx = chartBars.getContext("2d");
             new Chart(ctx, {
                 /* config */
             });
         }

         new Chart(ctx, {
             type: "bar",
             data: {
                 labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                 datasets: [{
                         label: "Tokopedia",
                         backgroundColor: "#4CAF50",
                         data: [50, 45, 22, 28, 50, 60, 76]
                     },
                     {
                         label: "TikTok",
                         backgroundColor: "#000000",
                         data: [30, 25, 40, 35, 60, 70, 80]
                     },
                     {
                         label: "Shopee",
                         backgroundColor: "#FF5722",
                         data: [40, 60, 55, 70, 65, 90, 100]
                     },
                     {
                         label: "Lazada",
                         backgroundColor: "#2196F3",
                         data: [20, 30, 25, 40, 45, 50, 60]
                     }
                 ]
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 plugins: {
                     legend: {
                         position: 'bottom',
                         labels: {
                             font: {
                                 size: 10
                             },
                             boxWidth: 10,
                             padding: 8
                         }
                     }
                 }
             }

         });



         var ctx2 = document.getElementById("chart-line").getContext("2d");

         new Chart(ctx2, {
             type: "line",
             data: {
                 labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                 datasets: [{
                         label: "Tokopedia",
                         backgroundColor: "#4CAF50",
                         data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220]
                     },
                     {
                         label: "TikTok",
                         backgroundColor: "#000000",
                         data: [80, 120, 150, 300, 280, 350, 400, 420, 380, 500, 520, 480]
                     },
                     {
                         label: "Shopee",
                         backgroundColor: "#FF5722",
                         data: [200, 300, 280, 450, 500, 600, 650, 620, 580, 700, 720, 750]
                     },
                     {
                         label: "Lazada",
                         backgroundColor: "#2196F3",
                         data: [60, 90, 100, 150, 180, 200, 220, 210, 190, 230, 250, 270]
                     }
                 ]
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 plugins: {
                     legend: {
                         position: 'bottom',
                         labels: {
                             font: {
                                 size: 10
                             },
                             boxWidth: 10,
                             padding: 8
                         }
                     }
                 }
             }

         });


         var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

         new Chart(ctx3, {
             type: "line",
             data: {
                 labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                 datasets: [{
                     label: "Tasks",
                     tension: 0,
                     borderWidth: 2,
                     pointRadius: 3,
                     pointBackgroundColor: "#43A047",
                     pointBorderColor: "transparent",
                     borderColor: "#43A047",
                     backgroundColor: "transparent",
                     fill: true,
                     data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                     maxBarThickness: 6

                 }],
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 plugins: {
                     legend: {
                         display: false,
                     }
                 },
                 interaction: {
                     intersect: false,
                     mode: 'index',
                 },
                 scales: {
                     y: {
                         grid: {
                             drawBorder: false,
                             display: true,
                             drawOnChartArea: true,
                             drawTicks: false,
                             borderDash: [4, 4],
                             color: '#e5e5e5'
                         },
                         ticks: {
                             display: true,
                             padding: 10,
                             color: '#737373',
                             font: {
                                 size: 14,
                                 lineHeight: 2
                             },
                         }
                     },
                     x: {
                         grid: {
                             drawBorder: false,
                             display: false,
                             drawOnChartArea: false,
                             drawTicks: false,
                             borderDash: [4, 4]
                         },
                         ticks: {
                             display: true,
                             color: '#737373',
                             padding: 10,
                             font: {
                                 size: 14,
                                 lineHeight: 2
                             },
                         }
                     },
                 },
             },
         });
     </script>
 <?php endif; ?>

 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="<?= base_url(); ?>assets/js/material-dashboard.min.js?v=3.2.0"></script>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 </body>

 </html>