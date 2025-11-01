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
    <div class="flex items-center">
        <div><?php include COMP_PATH . '/theme-toggle.php'; ?></div>
    </div>
    <div>
        <div>
            <h1 class="text-2xl font-bold">Bienvenido, <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
            <p class="text-gray-500">Tu rol actual es: <strong><?= htmlspecialchars($user['user_type']) ?></strong></p>
        </div>
    </div>
    <div class="max-h-[46rem] overflow-x-auto p-8">
        <div class="flex items-center">
            <h2 class="">Your rides</h2>
            <!-- Modal toggle -->
            <button data-modal-target="ride-modal" data-modal-toggle="ride-modal"
                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 active:bg-green-700"
                type="button">
                Create ride
            </button>
        </div>
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
                                <label for="departure_time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departure
                                    time</label>
                                <input type="datetime-local" name="departure_date" id="departure_date"
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
        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700 dt-debug">
            <thead class="sticky top-0 bg-white ltr:text-left rtl:text-right dark:bg-gray-900">
                <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                    <th class="px-3 py-2 whitespace-nowrap">Id</th>
                    <th class="px-3 py-2 whitespace-nowrap">Vehicle</th>
                    <th class="px-3 py-2 whitespace-nowrap">Name</th>
                    <th class="px-3 py-2 whitespace-nowrap">Departure place</th>
                    <th class="px-3 py-2 whitespace-nowrap">Arrive place</th>
                    <th class="px-3 py-2 whitespace-nowrap">Date</th>
                   
                    <th class="px-3 py-2 whitespace-nowrap">Price per seat</th>
                    <th class="px-3 py-2 whitespace-nowrap">Seats</th>
                    <th class="px-3 py-2 whitespace-nowrap">Modify</th>
                    <th class="px-3 py-2 whitespace-nowrap">Delete</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-center">
                <?php foreach ($rides as $ride): ?>
                    <?php
                    $uid = htmlspecialchars($ride['id']);//identificador único por fila
                    $mid = "ride-modify-modal-$uid";                   //id único del modal Modify
                    $did = "ride-delete-modal-$uid";                   //id único del modal Delete
                
                    ?>
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
                            
                            <?= htmlspecialchars(date('Y-m-d H:i', strtotime($ride['departure_date']))) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars('$' . number_format($ride['price_per_seat'], 2)) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars($ride['seats_offered']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <button data-modal-target="<?= $mid ?>" data-modal-toggle="<?= $mid ?>"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-white">
                                Modify
                            </button>
                            <!-- Modal MODIFICAR -->
                            <div id="<?= $mid ?>" aria-hidden="true"
                                class="hidden fixed inset-0 z-50 flex items-center justify-center">
                                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 w-full max-w-md">
                                    <div class="flex items-center justify-between border-b pb-2 mb-4">
                                        <h3 class="text-lg font-semibold">Modify ride #<?= $uid ?></h3>
                                        <button data-modal-toggle="<?= $mid ?>" class="p-2">✕</button>
                                    </div>

                                    <form class="p-4 md:p-5" action="/post/modify.php" method="POST">
                                        <input type="hidden" name="action" value="modify_ride">
                                        <input type="hidden" name="ride_id" value="<?= htmlspecialchars($ride['id']) ?>">

                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <!-- Name -->
                                            <div class="col-span-2">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" name="name" id="name"
                                                    value="<?= htmlspecialchars($ride['name']) ?>"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Type ride name or some description" required>
                                            </div>

                                            <!-- Vehicle -->
                                            <div class="col-span-2">
                                                <label for="vehicle_id"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle</label>
                                                <select id="vehicle_id" name="vehicle_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    required>
                                                    <option value="" disabled>Select your vehicle</option>
                                                    <?php
                                                    $vehiclesList = getVehicles($user['id']);
                                                    foreach ($vehiclesList as $vehicle):
                                                        $plate = htmlspecialchars($vehicle['plate_id']);
                                                        $label = htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' (' . $vehicle['plate_id'] . ')');
                                                        $selected = ($vehicle['plate_id'] === $ride['vehicle_plate']) ? 'selected' : '';
                                                        ?>
                                                        <option value="<?= $plate ?>" <?= $selected ?>><?= $label ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- Origin (departure) -->
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="origin"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Place departure (San Carlos)
                                                </label>
                                                <select id="origin" name="origin"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    required>
                                                    <?php
                                                    $places = ['ciudadquesada', 'florencia', 'quesada', 'pital', 'cutris', 'venecia', 'aguasarcas', 'pocosol', 'la_fortuna', 'palmera', 'venado', 'monterrey'];
                                                    echo '<option value="" disabled>Select place of departure</option>';
                                                    foreach ($places as $p) {
                                                        $sel = ($ride['origin'] === $p) ? 'selected' : '';
                                                        $text = ucwords(str_replace('_', ' ', $p));
                                                        echo '<option value="' . htmlspecialchars($p) . '" ' . $sel . '>' . htmlspecialchars($text) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- Destination (arrival) -->
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="destination"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Place arrival (San Carlos)
                                                </label>
                                                <select id="destination" name="destination"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    required>
                                                    <?php
                                                    echo '<option value="" disabled>Select place of arrival</option>';
                                                    foreach ($places as $p) {
                                                        $sel = ($ride['destination'] === $p) ? 'selected' : '';
                                                        $text = ucwords(str_replace('_', ' ', $p));
                                                        echo '<option value="' . htmlspecialchars($p) . '" ' . $sel . '>' . htmlspecialchars($text) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- Days -->
                                           

                                            <!-- Departure time -->
                                            <div class="col-span-2">
                                                <label for="departure_time"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Departure time
                                                </label>
                                                <input type="datetime-local" name="departure_date" id="departure_date"
                                                    value="<?= htmlspecialchars($ride['departure_date'], 0, 5) /* HH:MM */ ?>"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    required>
                                            </div>

                                            <!-- Price per seat -->
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="price_per_seat"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Price per seat
                                                </label>
                                                <input type="number" step="0.01" name="price_per_seat" id="price_per_seat"
                                                    value="<?= htmlspecialchars($ride['price_per_seat']) ?>"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="10.00" required>
                                            </div>

                                            <!-- Seats offered -->
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="seats_offered"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Seats
                                                </label>
                                                <input type="number" name="seats_offered" id="seats_offered"
                                                    value="<?= htmlspecialchars($ride['seats_offered']) ?>"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="5" required>
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
                                            Save changes
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <!-- Botón ELIMINAR -->
                            <button data-modal-target="<?= $did ?>" data-modal-toggle="<?= $did ?>"
                                class="rounded-lg bg-red-600 px-4 py-2 text-white">
                                Delete
                            </button>

                            <!-- Modal ELIMINAR -->
                            <div id="<?= $did ?>" aria-hidden="true"
                                class="hidden fixed inset-0 z-50 flex items-center justify-center">
                                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 w-full max-w-md">
                                    <div class="flex items-center justify-between border-b pb-2 mb-4">
                                        <h3 class="text-lg font-semibold">Delete ride #<?= $uid ?></h3>
                                        <button data-modal-toggle="<?= $did ?>" class="p-2">✕</button>
                                    </div>

                                    <form action="/post/delete.php" method="POST">
                                        <input type="hidden" name="action" value="delete_ride">
                                        <input type="hidden" name="ride_id" value="<?= $uid ?>">
                                        <p class="mb-4">Are you sure you want to delete this ride?</p>
                                        <button class="bg-red-600 text-white px-4 py-2 rounded">Confirm delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="max-h-[46rem] overflow-x-auto p-8">
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
                                                        <h2 class=" block mb-2 text-sm font-medium text-gray-900
                                                            dark:text-white">Vehicle
                                                            picture
                                                            </h-2>
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
    <div class="max-h-[46rem] overflow-x-auto p-8">
        <div class="flex items-center mb-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">Search rides</h2>
        </div>

        <!-- Wrapper recomendado por Flowbite -->
        <div class="relative overflow-auto shadow-md sm:rounded-lg tw-dt-fix">
            <table id="filter-table">
                <thead>
                    <tr>
                        <th>
                            <span class="flex items-center">
                                Name
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Category
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Brand
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Price
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Stock
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Total Sales
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Status
                                <svg class="w-4 h-4 ms-1" aria-hidden="" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple iMac</td>
                        <td>Computers</td>
                        <td>Apple</td>
                        <td>$1,299</td>
                        <td>50</td>
                        <td>200</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple iPhone</td>
                        <td>Mobile Phones</td>
                        <td>Apple</td>
                        <td>$999</td>
                        <td>120</td>
                        <td>300</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Galaxy</td>
                        <td>Mobile Phones</td>
                        <td>Samsung</td>
                        <td>$899</td>
                        <td>80</td>
                        <td>150</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Dell XPS 13</td>
                        <td>Computers</td>
                        <td>Dell</td>
                        <td>$1,099</td>
                        <td>30</td>
                        <td>120</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">HP Spectre x360</td>
                        <td>Computers</td>
                        <td>HP</td>
                        <td>$1,299</td>
                        <td>25</td>
                        <td>80</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Google Pixel 6</td>
                        <td>Mobile Phones</td>
                        <td>Google</td>
                        <td>$799</td>
                        <td>100</td>
                        <td>200</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Sony WH-1000XM4</td>
                        <td>Headphones</td>
                        <td>Sony</td>
                        <td>$349</td>
                        <td>60</td>
                        <td>150</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple AirPods Pro</td>
                        <td>Headphones</td>
                        <td>Apple</td>
                        <td>$249</td>
                        <td>200</td>
                        <td>300</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Asus ROG Zephyrus</td>
                        <td>Computers</td>
                        <td>Asus</td>
                        <td>$1,899</td>
                        <td>15</td>
                        <td>50</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Surface Pro 7
                        </td>
                        <td>Computers</td>
                        <td>Microsoft</td>
                        <td>$899</td>
                        <td>40</td>
                        <td>100</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung QLED TV</td>
                        <td>Televisions</td>
                        <td>Samsung</td>
                        <td>$1,299</td>
                        <td>25</td>
                        <td>70</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">LG OLED TV</td>
                        <td>Televisions</td>
                        <td>LG</td>
                        <td>$1,499</td>
                        <td>20</td>
                        <td>50</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Canon EOS R5</td>
                        <td>Cameras</td>
                        <td>Canon</td>
                        <td>$3,899</td>
                        <td>10</td>
                        <td>30</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nikon Z7 II</td>
                        <td>Cameras</td>
                        <td>Nikon</td>
                        <td>$3,299</td>
                        <td>8</td>
                        <td>25</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple Watch Series 7
                        </td>
                        <td>Wearables</td>
                        <td>Apple</td>
                        <td>$399</td>
                        <td>150</td>
                        <td>500</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Fitbit Charge 5</td>
                        <td>Wearables</td>
                        <td>Fitbit</td>
                        <td>$179</td>
                        <td>100</td>
                        <td>250</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Dyson V11 Vacuum</td>
                        <td>Home Appliances</td>
                        <td>Dyson</td>
                        <td>$599</td>
                        <td>30</td>
                        <td>90</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">iRobot Roomba i7+</td>
                        <td>Home Appliances</td>
                        <td>iRobot</td>
                        <td>$799</td>
                        <td>20</td>
                        <td>70</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Bose SoundLink Revolve
                        </td>
                        <td>Speakers</td>
                        <td>Bose</td>
                        <td>$199</td>
                        <td>80</td>
                        <td>200</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Sonos One</td>
                        <td>Speakers</td>
                        <td>Sonos</td>
                        <td>$219</td>
                        <td>60</td>
                        <td>180</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple iPad Pro</td>
                        <td>Tablets</td>
                        <td>Apple</td>
                        <td>$1,099</td>
                        <td>50</td>
                        <td>150</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Galaxy Tab S7
                        </td>
                        <td>Tablets</td>
                        <td>Samsung</td>
                        <td>$649</td>
                        <td>70</td>
                        <td>130</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Amazon Echo Dot</td>
                        <td>Smart Home</td>
                        <td>Amazon</td>
                        <td>$49</td>
                        <td>300</td>
                        <td>800</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Google Nest Hub</td>
                        <td>Smart Home</td>
                        <td>Google</td>
                        <td>$89</td>
                        <td>150</td>
                        <td>400</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">PlayStation 5</td>
                        <td>Gaming Consoles</td>
                        <td>Sony</td>
                        <td>$499</td>
                        <td>10</td>
                        <td>500</td>
                        <td>Out of Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Xbox Series X</td>
                        <td>Gaming Consoles</td>
                        <td>Microsoft</td>
                        <td>$499</td>
                        <td>15</td>
                        <td>450</td>
                        <td>Out of Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nintendo Switch</td>
                        <td>Gaming Consoles</td>
                        <td>Nintendo</td>
                        <td>$299</td>
                        <td>40</td>
                        <td>600</td>
                        <td>In Stock</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple MacBook Pro</td>
                        <td>Computers</td>
                        <td>Apple</td>
                        <td>$1,299</td>
                        <td>20</td>
                        <td>100</td>
                        <td>In Stock</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>