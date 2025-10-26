<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/showdata.php';
$user = $_SESSION['user'] ?? null;
$vehicles = getVehicles($user['id']);
?>


<div class="min-h-full w-full ">
    <div>
        <h1 class="text-2xl font-bold">Bienvenido, <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
        <p class="text-gray-500">Tu rol actual es: <strong><?= htmlspecialchars($user['user_type']) ?></strong></p>
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
                                    <label for="date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                    <input type="datetime-local" name="date" id="date"
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
                    <th class="px-3 py-2 whitespace-nowrap">Name</th>
                    <th class="px-3 py-2 whitespace-nowrap">Departure place</th>
                    <th class="px-3 py-2 whitespace-nowrap">Arrive place</th>
                    <th class="px-3 py-2 whitespace-nowrap">Date & Time</th>
                    <th class="px-3 py-2 whitespace-nowrap">Price per seat</th>
                    <th class="px-3 py-2 whitespace-nowrap">Seats</th>
                    <th class="px-3 py-2 whitespace-nowrap">Modify</th>
                    <th class="px-3 py-2 whitespace-nowrap">Delete</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Nandor the Relentless</td>
                    <td class="px-3 py-2 whitespace-nowrap">04/06/1262</td>
                    <td class="px-3 py-2 whitespace-nowrap">Vampire Warrior</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Laszlo Cravensworth</td>
                    <td class="px-3 py-2 whitespace-nowrap">19/10/1678</td>
                    <td class="px-3 py-2 whitespace-nowrap">Vampire Gentleman</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Nadja</td>
                    <td class="px-3 py-2 whitespace-nowrap">15/03/1593</td>
                    <td class="px-3 py-2 whitespace-nowrap">Vampire Seductress</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Colin Robinson</td>
                    <td class="px-3 py-2 whitespace-nowrap">01/09/1971</td>
                    <td class="px-3 py-2 whitespace-nowrap">Energy Vampire</td>
                    <td class="px-3 py-2 whitespace-nowrap">$53,000</td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Guillermo de la Cruz</td>
                    <td class="px-3 py-2 whitespace-nowrap">18/11/1991</td>
                    <td class="px-3 py-2 whitespace-nowrap">Familiar/Vampire Hunter</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                </tr>
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
                        <form class="p-4 md:p-5" action="/post/insert.php" method="POST">
                            <input type="hidden" name="action" value="register_vehicle">
                            <div class="grid gap-4 mb-4 grid-cols-2">
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
                                    <select id="color" name="color" id="color"
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
                                <img src="<?= htmlspecialchars($vehicle['vehicle_picture']) ?>" alt="Vehicle picture"
                                    class="h-8 w-24 object-cover rounded-lg mx-auto">
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <button
                                    class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                                    Modify
                                </button>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <button
                                    class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>