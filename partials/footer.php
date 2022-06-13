<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- <script src="assets/js/off-canvas.js"></script> -->
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<!-- <script src="assets/js/todolist.js"></script> -->
<script src="includes/sweetalert2/sweetalert2@9.js"></script>
<script src="includes/flexdatalist/jquery.flexdatalist.min.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="assets/js/dashboard.js"></script>
<script src="assets/vendors/waitMe/waitMe.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
<script type="text/javascript" src="includes/dataTables/datatables.min.js">
</script>
<script src="includes/jqueryui/jquery-ui.js"></script>
<!-- End custom js for this page-->
<script>
    $(function () {
        const classSide = localStorage.sideClass || 'sidebar-dark sidebar-icon-only'
        const sidebarDarkThemeBtn = document.getElementById('sidebar-dark-theme')
        const sidebarLightThemeBtn = document.getElementById('sidebar-light-theme')
        const bodyEl = document.getElementById('body')
        bodyEl.className = classSide
        sidebarDarkThemeBtn.onclick = () => {
            localStorage.sideClass = 'sidebar-dark sidebar-icon-only'
        }
        sidebarLightThemeBtn.onclick = () => {
            localStorage.sideClass = 'sidebar-light sidebar-icon-only'
        }

        const classes = localStorage.navClass ||
            'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow'
        const topMenu = document.getElementById('topMenu')
        topMenu.className = classes

        const themesSelector = document.querySelectorAll('.tiles')

        for (let itemS of themesSelector) {
            itemS.onclick = () => {
                const themeS = itemS.classList;

                if (themeS.contains('primary')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow navbar-primary'
                    localStorage.navClass = valueS
                } else if (themeS.contains('success')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow navbar-success'
                    localStorage.navClass = valueS
                } else if (themeS.contains('warning')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow navbar-warning'
                    localStorage.navClass = valueS
                } else if (themeS.contains('danger')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow navbar-danger'
                    localStorage.navClass = valueS
                } else if (themeS.contains('info')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow navbar-info'
                    localStorage.navClass = valueS
                } else if (themeS.contains('dark')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow navbar-dark'
                    localStorage.navClass = valueS
                } else if (themeS.contains('default')) {
                    let valueS = topMenu.className =
                        'navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow'
                    localStorage.navClass = valueS
                }
            }
        }
    })
    document.addEventListener('DOMContentLoaded', () => {
        $("#body").waitMe({
            effect: "win8",
            bg: "rgba(0,0,0,.9)",
            color: "#FFF",
        });
        setTimeout(() => {
            $("#body").waitMe("hide");
        }, 800);
    })
    // const clock = document.getElementById('clock')
    // setInterval(() => {
    //     const date = new Date()
    //     const time = date.toLocaleTimeString()
    //     clock.textContent = time
    // }, 1000);
    const offCanvas = document.querySelector('.bars')
    const sidebarOffCanvas = document.querySelector('.sidebar-offcanvas')
    offCanvas.addEventListener('click', ()=> {
        sidebarOffCanvas.classList.toggle('active')
    })    
</script>
</body>

</html>