<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Admin Panel</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>

</head>

<?php
include("../../clases/Conexion.php");
include("../../clases/Admin.php");
$base_url = "localhost/barberShop/";
$Admin = new Admin();
$barbersAvgPuntuacion = $Admin->getGeneralAvgBarbers();
$mostFinishedApoinment = $Admin->mostFinishedApoitments();
$totalClients = $Admin->getAllRegisteredClients();
$employeesWorseAvg = $Admin->generateEmployeeWorsePuntationAverage();
$mostCanceledEmployees= $Admin->getEMployeesWithMoreCanceledApointments();
$servicesStats = $Admin->getServicesStats();
$lastsApoitments = $Admin->getLastApointments();
?>
<body class="text-gray-800 font-inter">
    <!--sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="../../../"
         class="flex items-center pb-4 border-b border-b-gray-800">

            <h2 class="font-bold text-2xl">BARBER <span class="bg-indigo-600 text-white px-2 rounded-md">SHOP</span></h2>
        </a>
        <ul class="mt-4">
            <span class="text-gray-400 font-bold">ADMIN</span>
            <li class="mb-1 group">
                <a href="./adminPanel.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md ">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <a href="./adminPanelSerivicios.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md">
                    <i class='bx bx-bar-chart-alt-2 mr-3 text-lg'></i>                
                    <span class="text-sm">Servicios</span>
                </a>
                <a href="./adminPanelEmployee.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md">
                    <i class='bx bx-stats mr-3 text-lg'></i>                
                    <span class="text-user">Empleados</span>
                </a>
                <a href="./adminPanelCitas.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Citas</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end sidenav -->

    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
        <!-- navbar -->
        <div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
            
            </button>

            <ul class="ml-auto flex items-center">
                <li class="mr-1 dropdown">
                    <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                        <form action="" class="p-4 border-b border-b-gray-100">
                            <div class="relative w-full">
                                <input type="text" class="py-2 pr-4 pl-10 bg-gray-50 w-full outline-none border border-gray-100 rounded-md text-sm focus:border-blue-500" placeholder="Search...">
                                <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-900"></i>
                            </div>
                        </form>
                    </div>
                </li>
                <button id="fullscreen-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;transform: ;msFilter:;"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path></svg>
                </button>
                <script>
                    const fullscreenButton = document.getElementById('fullscreen-button');
                
                    fullscreenButton.addEventListener('click', toggleFullscreen);
                
                    function toggleFullscreen() {
                        if (document.fullscreenElement) {
                            // If already in fullscreen, exit fullscreen
                            document.exitFullscreen();
                        } else {
                            // If not in fullscreen, request fullscreen
                            document.documentElement.requestFullscreen();
                        }
                    }
                </script>

                <li class="dropdown ml-3">
                    <button type="button" class="dropdown-toggle flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 relative">
                            <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                                <img class="w-8 h-8 rounded-full" src="https://th.bing.com/th/id/R.19e104bef8756cd73c7ddbd9b2ae2043?rik=U65n%2fLOhHWpdqA&pid=ImgRaw&r=0" alt=""/>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="p-2 md:block text-left">
                            <h2 class="text-sm font-semibold text-gray-800">Admin</h2>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>                
                    </button>
                    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Settings</a>
                        </li>
                        <li>
                            <form method="POST" action="">
                                <a role="menuitem" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    Log Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- end navbar -->

      <!-- Content -->
        <div class="p-6">
          <!-- card panel  -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold"><?php echo $barbersAvgPuntuacion["Promedio_Puntuacion"]." / 5 ⭐"?></div>
                            </div>
                            <div class="text-sm font-medium text-gray-400">Promedio clasificación de todos los barberos</div>
                        </div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div> 
                    </div>

                    <a 
                    target="_blank"
                    href="../../fpdf/employeeAvgReview.php" 
                    class="text-indigo-500 font-medium text-sm hover:text-indigo-800">Ver</a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold">
                                    <?php echo $mostFinishedApoinment["Nombre"]." ".$mostFinishedApoinment["Apellido"];?></div>
                            </div>
                            <p class="mb-3 text-bold font-medium text-gray-800"><?php echo $mostFinishedApoinment["citas_terminadas"]." Citas"?></p>
                            <div class="text-sm font-medium text-gray-400">Empleado con mas citas realizadas</div>
                        </div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div> 
                    </div>
                    <a
                    target="_blank" 
                    href="../../fpdf/avgEmployeeParticipation.php" 
                    class="text-indigo-500 font-medium text-sm hover:text-indigo-800">Ver</a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1">Reporte de citas por cada empleado</div>
                            <div class="text-sm font-medium text-gray-400">Total de citas de cada empleado</div>
                        </div>
                         <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                                </li>
                            </ul>
                        </div> 
                    </div>
                    <a
                    target="_blank" 
                    href="../../fpdf/getAllCitasPerEmployee.php" 
                    class="text-indigo-500 font-medium text-sm hover:text-indigo-800">Ver</a>
                </div>
            </div>
          <!-- end of card panel  -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
              <!-- user panel -->
                <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                    <div class="rounded-t mb-0 px-0 border-0">
                      <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                          <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Empleados con peor promedio de puntuación</h3>
                        </div>
                      </div>
                      <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                          <thead>
                            <tr>
                            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">ID</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nombre y Apellido</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Promedio de puntuación</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($employeesWorseAvg as $employee):?>
                            <tr class="text-gray-700 dark:text-gray-100">
                              <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                <?php echo $employee["id_Empleado"]?>
                              </th>
                              <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                <?php echo $employee["Nombre"]." ".$employee["Apellido"]?>
                              </th>
                              <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <?php echo $employee["Promedio_Puntuacion"]?>
                              </td>
                            </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              <!-- end of user panel -->
              <!-- activite panel -->
              <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                    <div class="rounded-t mb-0 px-0 border-0">
                      <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                          <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Empleados con más citas canceladas</h3>
                        </div>
                      </div>
                      <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                          <thead>
                            <tr>
                            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">ID</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nombre y Apellido</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Citas canceladas</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($mostCanceledEmployees as $employee):?>
                            <tr class="text-gray-700 dark:text-gray-100">
                              <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                <?php echo $employee["Id_Empleado"]?>
                              </th>
                              <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                <?php echo $employee["Nombre"]." ".$employee["Apellido"]?>
                              </th>
                              <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <?php echo $employee["cantidad_citas_canceladas"]?>
                              </td>
                            </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- end of activite panel -->
            </div>
        </div>
      <!-- End Content -->
    </main>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // start: Sidebar
        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        const main = document.querySelector('.main')
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })
        sidebarOverlay.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')
        })
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault()
                const parent = item.closest('.group')
                if (parent.classList.contains('selected')) {
                    parent.classList.remove('selected')
                } else {
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                        i.closest('.group').classList.remove('selected')
                    })
                    parent.classList.add('selected')
                }
            })
        })
        // end: Sidebar



        // start: Popper
        const popperInstance = {}
        document.querySelectorAll('.dropdown').forEach(function (item, index) {
            const popperId = 'popper-' + index
            const toggle = item.querySelector('.dropdown-toggle')
            const menu = item.querySelector('.dropdown-menu')
            menu.dataset.popperId = popperId
            popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 24,
                        },
                    },
                ],
                placement: 'bottom-end'
            });
        })
        document.addEventListener('click', function (e) {
            const toggle = e.target.closest('.dropdown-toggle')
            const menu = e.target.closest('.dropdown-menu')
            if (toggle) {
                const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
                const popperId = menuEl.dataset.popperId
                if (menuEl.classList.contains('hidden')) {
                    hideDropdown()
                    menuEl.classList.remove('hidden')
                    showPopper(popperId)
                } else {
                    menuEl.classList.add('hidden')
                    hidePopper(popperId)
                }
            } else if (!menu) {
                hideDropdown()
            }
        })

        function hideDropdown() {
            document.querySelectorAll('.dropdown-menu').forEach(function (item) {
                item.classList.add('hidden')
            })
        }
        function showPopper(popperId) {
            popperInstance[popperId].setOptions(function (options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: 'eventListeners', enabled: true },
                    ],
                }
            });
            popperInstance[popperId].update();
        }
        function hidePopper(popperId) {
            popperInstance[popperId].setOptions(function (options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: 'eventListeners', enabled: false },
                    ],
                }
            });
        }
        // end: Popper



        // start: Tab
        document.querySelectorAll('[data-tab]').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault()
                const tab = item.dataset.tab
                const page = item.dataset.tabPage
                const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page + '"]')
                document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function (i) {
                    i.classList.remove('active')
                })
                document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function (i) {
                    i.classList.add('hidden')
                })
                item.classList.add('active')
                target.classList.remove('hidden')
            })
        })
        // end: Tab



        // start: Chart
        new Chart(document.getElementById('order-chart'), {
            type: 'line',
            data: {
                labels: generateNDays(7),
                datasets: [
                    {
                        label: 'Active',
                        data: generateRandomData(7),
                        borderWidth: 1,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgb(59 130 246 / .05)',
                        tension: .2
                    },
                    {
                        label: 'Completed',
                        data: generateRandomData(7),
                        borderWidth: 1,
                        fill: true,
                        pointBackgroundColor: 'rgb(16, 185, 129)',
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgb(16 185 129 / .05)',
                        tension: .2
                    },
                    {
                        label: 'Canceled',
                        data: generateRandomData(7),
                        borderWidth: 1,
                        fill: true,
                        pointBackgroundColor: 'rgb(244, 63, 94)',
                        borderColor: 'rgb(244, 63, 94)',
                        backgroundColor: 'rgb(244 63 94 / .05)',
                        tension: .2
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function generateNDays(n) {
            const data = []
            for(let i=0; i<n; i++) {
                const date = new Date()
                date.setDate(date.getDate()-i)
                data.push(date.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric'
                }))
            }
            return data
        }
        function generateRandomData(n) {
            const data = []
            for(let i=0; i<n; i++) {
                data.push(Math.round(Math.random() * 10))
            }
            return data
        }
        // end: Chart

        
    </script>

</body>
</html>