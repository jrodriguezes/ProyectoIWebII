<?php
require_once __DIR__ . '/../config/session.php';
$user = $_SESSION['user'] ?? null;
?>

<div class="min-h-full w-full ">
    <div>
        <h1 class="text-2xl font-bold">Bienvenido, <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
        <p class="text-gray-500">Tu rol actual es: <strong><?= htmlspecialchars($user['user_type']) ?></strong></p>
    </div>

    <div class="max-h-46 overflow-x-auto p-8">
        <h2>Your rides</h2>
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
        <div>
            <h2>Your vehicles</h2>
            <!-- Modal toggle -->
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Toggle modal
            </button>

            <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Create New Product
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type product name" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input type="number" name="price" id="price"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="$2999" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <select id="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected="">Select category</option>
                                        <option value="TV">TV/Monitors</option>
                                        <option value="PC">PC</option>
                                        <option value="GA">Gaming/Console</option>
                                        <option value="PH">Phones</option>
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                        Description</label>
                                    <textarea id="description" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write product description here"></textarea>
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
                                Add new product
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
            <thead class="sticky top-0 bg-white ltr:text-left rtl:text-right dark:bg-gray-900">
                <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                    <th class="px-3 py-2 whitespace-nowrap">Plate Id</th>
                    <th class="px-3 py-2 whitespace-nowrap">Color</th>
                    <th class="px-3 py-2 whitespace-nowrap">Model</th>
                    <th class="px-3 py-2 whitespace-nowrap">Year</th>
                    <th class="px-3 py-2 whitespace-nowrap">Seats capacity</th>
                    <th class="px-3 py-2 whitespace-nowrap">Vehicle picture</th>
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
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                            Modify
                        </button>
                    </td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Laszlo Cravensworth</td>
                    <td class="px-3 py-2 whitespace-nowrap">19/10/1678</td>
                    <td class="px-3 py-2 whitespace-nowrap">Vampire Gentleman</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                            Modify
                        </button>
                    </td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Nadja</td>
                    <td class="px-3 py-2 whitespace-nowrap">15/03/1593</td>
                    <td class="px-3 py-2 whitespace-nowrap">Vampire Seductress</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                            Modify
                        </button>
                    </td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Colin Robinson</td>
                    <td class="px-3 py-2 whitespace-nowrap">01/09/1971</td>
                    <td class="px-3 py-2 whitespace-nowrap">Energy Vampire</td>
                    <td class="px-3 py-2 whitespace-nowrap">$53,000</td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                            Modify
                        </button>
                    </td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>

                <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                    <td class="px-3 py-2 whitespace-nowrap">Guillermo de la Cruz</td>
                    <td class="px-3 py-2 whitespace-nowrap">18/11/1991</td>
                    <td class="px-3 py-2 whitespace-nowrap">Familiar/Vampire Hunter</td>
                    <td class="px-3 py-2 whitespace-nowrap">$0</td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 active:bg-yellow-600">
                            Modify
                        </button>
                    </td>
                    <td>
                        <button
                            class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 active:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>