<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/VehiclesData.php';

require_once __DIR__ . '/../common/auth_guard.php';

$user = $_SESSION['user'];
$vehicles = getVehicles($user['id']);
$rides = getRidesByDriver($user['id']);

?>

<div class="min-h-full w-full ">
    <div>
        <?php include __DIR__ . "/layouts/navbar.php" ?>
    </div>
    <div>
        <div>
            <h1 class="text-2xl font-bold">Bienvenido, <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
            <p class="text-gray-500">Tu rol actual es: <strong><?= htmlspecialchars($user['user_type']) ?></strong></p>
        </div>
        <div>
            <form action="/post/logout.php" method="POST">
                <button type="submit"
                    class="group flex items-center justify-between gap-3 rounded-lg border border-indigo-600 px-5 py-3 text-indigo-600 transition-all duration-200 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span class="font-medium">Cerrar sesión</span>

                </button>
            </form>
        </div>
    </div>
    <div class="max-h-46 overflow-x-auto p-8">
        <div class="flex items-center">
            <h2 class="">Your rides</h2>
            <!-- Modal toggle -->
            <button data-modal-target="ride-modal" data-modal-toggle="ride-modal"
                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 active:bg-green-700"
                type="button">
                Create ride
            </button>
            <!-- Main modal -->
            <div id="ride-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Create new ride
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="ride-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5" action="/post/insert.php" method="POST">
                            <input type="hidden" name="action" value="register_ride">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type ride name or some description" required="">
                                </div>

                                <div class="col-span-2">
                                    <label for="vehicle_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle</label>
                                    <select id="vehicle" name="vehicle_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg">
                                        <option selected>Select your vehicle</option>
                                        <?php
                                        $vehiclesList = getVehicles($user['id']);

                                        foreach ($vehiclesList as $vehicle): ?>
                                            <option value="<?= htmlspecialchars($vehicle['plate_id']) ?>">
                                                <?= htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' (' . $vehicle['plate_id'] . ')') ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>


                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label for="departure"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Place arrival (San Carlos)
                                    </label>
                                    <select id="departure" name="departure" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
           focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 
           dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 
           dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected>Select place of arrival</option>
                                        <option value="ciudadquesada">Ciudad Quesada</option>
                                        <option value="florencia">Florencia</option>
                                        <option value="quesada">Quesada Centro</option>
                                        <option value="pital">Pital</option>
                                        <option value="cutris">Cutris</option>
                                        <option value="venecia">Venecia</option>
                                        <option value="aguasarcas">Aguas Zarcas</option>
                                        <option value="pocosol">Pocosol</option>
                                        <option value="la_fortuna">La Fortuna</option>
                                        <option value="palmera">Palmera</option>
                                        <option value="venado">Venado</option>
                                        <option value="monterrey">Monterrey</option>
                                    </select>
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label for="arrival"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Place departure (San Carlos)
                                    </label>
                                    <select id="arrival" name="arrival" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
           focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 
           dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 
           dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected>Select place of departure</option>
                                        <option value="ciudadquesada">Ciudad Quesada</option>
                                        <option value="florencia">Florencia</option>
                                        <option value="quesada">Quesada Centro</option>
                                        <option value="pital">Pital</option>
                                        <option value="cutris">Cutris</option>
                                        <option value="venecia">Venecia</option>
                                        <option value="aguasarcas">Aguas Zarcas</option>
                                        <option value="pocosol">Pocosol</option>
                                        <option value="la_fortuna">La Fortuna</option>
                                        <option value="palmera">Palmera</option>
                                        <option value="venado">Venado</option>
                                        <option value="monterrey">Monterrey</option>
                                    </select>
                                </div>



                                <div class="col-span-2">
                                    <label for="days"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Days</label>
                                    <div>

                                        <label for="monday">Monday</label>
                                        <input type="checkbox" id="monday" name="monday" value="Mo"
                                            class="accent-black">

                                        <label for="tuesday">Tuesday</label>
                                        <input type="checkbox" id="tuesday" name="tuesday" value="Tu"
                                            class="accent-black">

                                        <label for="wednesday">Wednesday</label>
                                        <input type="checkbox" id="wednesday" name="wednesday" value="We"
                                            class="accent-black">

                                        <label for="thursday">Thursday</label>
                                        <input type="checkbox" id="thursday" name="thursday" value="Th"
                                            class="accent-black">

                                        <label for="friday">Friday</label>
                                        <input type="checkbox" id="friday" name="friday" value="Fr"
                                            class="accent-black">

                                        <label for="saturday">Saturday</label>
                                        <input type="checkbox" id="saturday" name="saturday" value="Sa"
                                            class="accent-black">

                                        <label for="sunday">Sunday</label>
                                        <input type="checkbox" id="sunday" name="sunday" value="Su"
                                            class="accent-black">

                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label for="departure_time"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departure
                                        time</label>
                                    <input type="time" name="departure_time" id="departure_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required="">
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price_seats"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price per
                                        seat</label>
                                    <input type="number" name="price_seats" id="price_seats"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="$10" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="seats"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats
                                    </label>
                                    <input type="number" name="seats" id="seats"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="5" required="">
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Add new ride
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
            <thead class="sticky top-0 bg-white ltr:text-left rtl:text-right dark:bg-gray-900">
                <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                    <th class="px-3 py-2 whitespace-nowrap">Id</th>
                    <th class="px-3 py-2 whitespace-nowrap">Vehicle</th>
                    <th class="px-3 py-2 whitespace-nowrap">Name</th>
                    <th class="px-3 py-2 whitespace-nowrap">Departure place</th>
                    <th class="px-3 py-2 whitespace-nowrap">Arrive place</th>
                    <th class="px-3 py-2 whitespace-nowrap">Date</th>
                    <TH class="px-3 py-2 whitespace-nowrap">Time</TH>
                    <th class="px-3 py-2 whitespace-nowrap">Price per seat</th>
                    <th class="px-3 py-2 whitespace-nowrap">Seats</th>
                    <th class="px-3 py-2 whitespace-nowrap">Modify</th>
                    <th class="px-3 py-2 whitespace-nowrap">Delete</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-center">
                <?php foreach ($rides as $ride): ?>
                    <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['id']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['vehicle_plate']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['name']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['origin']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['destination']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?php
                            $daysString = "";

                            if (strpos($ride['days'], 'Mo') !== false) {
                                $daysString .= "Monday, ";
                            }
                            if (strpos($ride['days'], 'Tu') !== false) {
                                $daysString .= "Tuesday, ";
                            }
                            if (strpos($ride['days'], 'We') !== false) {
                                $daysString .= "Wednesday, ";
                            }
                            if (strpos($ride['days'], 'Th') !== false) {
                                $daysString .= "Thursday, ";
                            }
                            if (strpos($ride['days'], 'Fr') !== false) {
                                $daysString .= "Friday, ";
                            }
                            if (strpos($ride['days'], 'Sa') !== false) {
                                $daysString .= "Saturdasy, ";
                            }
                            if (strpos($ride['days'], 'Su') !== false) {
                                $daysString .= "Sunday, ";
                            }
                            ?>
                            <?= htmlspecialchars($daysString) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['departure_time']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars('$' . number_format($ride['price_per_seat'], 2)) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['seats_offered']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <button data-modal-target="<?= $mid ?>" data-modal-toggle="<?= $mid ?>"
                                class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                                Modify
                            </button>
                            <div id="<?= $mid ?>" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Modify vehicle
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="<?= $mid ?>">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form class="p-4 md:p-5" action="/post/modify.php" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="action" value="modify_vehicle">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="plate_id"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plate
                                                        Id</label>
                                                    <input type="text" value="<?= $vehicle['plate_id'] ?>"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Type plate Id. Example: (ABC-123)" disabled>

                                                    <input type="hidden" name="plate_id" id="plate_id"
                                                        value="<?= $vehicle['plate_id'] ?>">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="color"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color</label>
                                                    <select id="color" name="color" class=" bg-gray-50 border border-gray-300 text-gray-900
                                                            text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500
                                                            block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500
                                                            dark:placeholder-gray-400 dark:text-white
                                                            dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option value="<?= $vehicle['color'] ?>"
                                                            selected="<?= $vehicle['color'] ?>">Selected
                                                            color:<?= $vehicle['color'] ?>
                                                        </option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Green">Green</option>
                                                        <option value="White">White</option>
                                                        <option value="Cyan">Cyan</option>
                                                        <option value="Gray">Gray</option>
                                                        <option value="Red">Red</option>
                                                    </select>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="brand"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                                    <input type="text" name="brand" id="brand"
                                                        value="<?= $vehicle['brand'] ?>"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Toyota" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="model"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model
                                                    </label>
                                                    <input type="text" name="model" id="model"
                                                        value="<?= $vehicle['model'] ?>"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Type vehicle model" required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="year"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                                                    <input type="number" name="year" id="year"
                                                        value="<?= $vehicle['year'] ?>"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="2025" required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="seats"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats
                                                        capacity</label>
                                                    <input type="number" name="seats" id="seats"
                                                        value="<?= $vehicle['seats'] ?>"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="5" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="<?= $fileId ?>
                                                            class=" block mb-2 text-sm font-medium text-gray-900
                                                        dark:text-white">Vehicle
                                                        picture
                                                    </label>
                                                    <img src="<?= $imgUrl ?>" alt="Vehicle picture"
                                                        class="h-12 w-24 object-cover rounded-lg mx-auto">
                                                    <input type="file" name="modify-vehicle-picture" id="<?= $fileId ?>"
                                                        accept="image/*"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Modify vehicle
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <button data-modal-target="<?= $did ?>" data-modal-toggle="<?= $did ?>"
                                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                                Delete
                            </button>
                            <div id="<?= $did ?>" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Delete vehicle
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="<?= $did ?>">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form class="p-4 md:p-5" action="/post/delete.php" method="POST">
                                            <input type="hidden" name="action" value="delete_vehicle">
                                            <div class="grid gap-4 mb-4 grid-cols-2 text-center">
                                                <div class="col-span-2">
                                                    <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Are
                                                        you sure you want to delete this vehicle?
                                                    </p>
                                                    <input type="hidden" name="plate_id" id="plate_id"
                                                        value="<?= $vehicle["plate_id"] ?>">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Confirm delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="max-h-46 overflow-x-auto p-8">
        <div class="flex items-center">
            <h2 class="">Your vehicles</h2>
            <!-- Modal toggle -->
            <button data-modal-target="vehicle-modal" data-modal-toggle="vehicle-modal"
                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 active:bg-green-700"
                type="button">
                Add new vehicle
            </button>
            <!-- Main modal -->
            <div id="vehicle-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Add new vehicle
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="vehicle-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5" action="/post/insert.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="register_vehicle">
                            <div class="grid gap-4 mb-4 grid-cols-2 text-center">
                                <div class="col-span-2">
                                    <label for="plate_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plate
                                        Id</label>
                                    <input type="text" name="plate_id" id="plate_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type plate Id. Example: (ABC-123)" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color</label>
                                    <select id="color" name="color"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected="">Select color</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Green">Green</option>
                                        <option value="White">White</option>
                                        <option value="Cyan">Cyan</option>
                                        <option value="Gray">Gray</option>
                                        <option value="Red">Red</option>
                                    </select>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="brand"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                    <input type="text" name="brand" id="brand"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Toyota" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="model"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model
                                    </label>
                                    <input type="text" name="model" id="model"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type vehicle model" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="year"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                                    <input type="number" name="year" id="year"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="2025" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="seats"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats
                                        capacity</label>
                                    <input type="number" name="seats" id="seats"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="5" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="vehicle-picture"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle
                                        picture
                                    </label>
                                    <input type="file" name="vehicle-picture" id="vehicle-picture"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required="">
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Add new vehicle
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
            <thead class="sticky top-0 bg-white ltr:text-left rtl:text-right dark:bg-gray-900">
                <tr class="*:font-medium *:text-gray-900 dark:*:text-white text-center">
                    <th class="px-3 py-2 whitespace-nowrap">Plate Id</th>
                    <th class="px-3 py-2 whitespace-nowrap">Color</th>
                    <th class="px-3 py-2 whitespace-nowrap">Brand</th>
                    <th class="px-3 py-2 whitespace-nowrap">Model</th>
                    <th class="px-3 py-2 whitespace-nowrap">Year</th>
                    <th class="px-3 py-2 whitespace-nowrap">Seats capacity</th>
                    <th class="px-3 py-2 whitespace-nowrap">Vehicle picture</th>
                    <th class="px-3 py-2 whitespace-nowrap">Modify</th>
                    <th class="px-3 py-2 whitespace-nowrap">Delete</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-center">
                <?php if (empty($vehicles)): ?>
                    <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white ">
                        <td class="px-3 py-2 whitespace-nowrap">No hay vehículos registrados aún.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <?php
                        $uid = htmlspecialchars($vehicle['plate_id']);//identificador único por fila
                        $mid = "vehicle-modify-modal-$uid";                   //id único del modal Modify
                        $did = "vehicle-delete-modal-$uid";                   //id único del modal Delete
                        $fileId = "modify-vehicle-picture-$uid";              //id único para el input file
                        $imgUrl = rtrim(BASE_URL ?? '', '/') . htmlspecialchars($vehicle['vehicle_picture']); // URL completa
                        ?>
                        <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white ">
                            <td class="px-3 py-2 whitespace-nowrap">
                                <?= $vehicle['plate_id'] ?>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <?= $vehicle['color'] ?>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <?= $vehicle['brand'] ?>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <?= $vehicle['model'] ?>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <?= $vehicle['year'] ?>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <?= $vehicle['seats'] ?>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <img src="<?= $imgUrl ?>" alt="Vehicle picture"
                                    class="h-8 w-24 object-cover rounded-lg mx-auto">
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <button data-modal-target="<?= $mid ?>" data-modal-toggle="<?= $mid ?>"
                                    class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                                    Modify
                                </button>
                                <div id="<?= $mid ?>" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Modify vehicle
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="<?= $mid ?>">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5" action="/post/modify.php" method="POST"
                                                enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="modify_vehicle">
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="plate_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plate
                                                            Id</label>
                                                        <input type="text" value="<?= $vehicle['plate_id'] ?>"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Type plate Id. Example: (ABC-123)" disabled>

                                                        <input type="hidden" name="plate_id" id="plate_id"
                                                            value="<?= $vehicle['plate_id'] ?>">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="color"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color</label>
                                                        <select id="color" name="color" class=" bg-gray-50 border border-gray-300 text-gray-900
                                                            text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500
                                                            block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500
                                                            dark:placeholder-gray-400 dark:text-white
                                                            dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option value="<?= $vehicle['color'] ?>"
                                                                selected="<?= $vehicle['color'] ?>">Selected
                                                                color:<?= $vehicle['color'] ?>
                                                            </option>
                                                            <option value="Blue">Blue</option>
                                                            <option value="Yellow">Yellow</option>
                                                            <option value="Green">Green</option>
                                                            <option value="White">White</option>
                                                            <option value="Cyan">Cyan</option>
                                                            <option value="Gray">Gray</option>
                                                            <option value="Red">Red</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="brand"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                                        <input type="text" name="brand" id="brand"
                                                            value="<?= $vehicle['brand'] ?>"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Toyota" required="">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="model"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model
                                                        </label>
                                                        <input type="text" name="model" id="model"
                                                            value="<?= $vehicle['model'] ?>"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Type vehicle model" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="year"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                                                        <input type="number" name="year" id="year"
                                                            value="<?= $vehicle['year'] ?>"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="2025" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="seats"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats
                                                            capacity</label>
                                                        <input type="number" name="seats" id="seats"
                                                            value="<?= $vehicle['seats'] ?>"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="5" required="">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="<?= $fileId ?>
                                                            class=" block mb-2 text-sm font-medium text-gray-900
                                                            dark:text-white">Vehicle
                                                            picture
                                                        </label>
                                                        <img src="<?= $imgUrl ?>" alt="Vehicle picture"
                                                            class="h-12 w-24 object-cover rounded-lg mx-auto">
                                                        <input type="file" name="modify-vehicle-picture" id="<?= $fileId ?>"
                                                            accept="image/*"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Modify vehicle
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <button data-modal-target="<?= $did ?>" data-modal-toggle="<?= $did ?>"
                                    class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                                    Delete
                                </button>
                                <div id="<?= $did ?>" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Delete vehicle
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="<?= $did ?>">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5" action="/post/delete.php" method="POST">
                                                <input type="hidden" name="action" value="delete_vehicle">
                                                <div class="grid gap-4 mb-4 grid-cols-2 text-center">
                                                    <div class="col-span-2">
                                                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                            Are
                                                            you sure you want to delete this vehicle?
                                                        </p>
                                                        <input type="hidden" name="plate_id" id="plate_id"
                                                            value="<?= $vehicle["plate_id"] ?>">
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Confirm delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>