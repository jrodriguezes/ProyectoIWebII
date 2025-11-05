<?php
require_once __DIR__ . '/../models/UsersData.php';
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
            <button data-modal-target="user-modal" data-modal-toggle="user-modal"
                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 active:bg-green-700"
                type="button">
                Create user
            </button>
        </div>

    </div>

    <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700 dt-debug">
            <thead class="sticky top-0 bg-white ltr:text-left rtl:text-right dark:bg-gray-900">
                <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                    <th class="px-3 py-2 whitespace-nowrap">Id</th>
                    <th class="px-3 py-2 whitespace-nowrap">First name</th>
                    <th class="px-3 py-2 whitespace-nowrap">Last name</th>
                    <th class="px-3 py-2 whitespace-nowrap">Birth date</th>
                    <th class="px-3 py-2 whitespace-nowrap">Email</th>
                    <th class="px-3 py-2 whitespace-nowrap">Phone</th>
                   
                    <th class="px-3 py-2 whitespace-nowrap">Profile photo</th>
                    <th class="px-3 py-2 whitespace-nowrap">User type</th>
                    <th class="px-3 py-2 whitespace-nowrap">Status</th>
                    <th class="px-3 py-2 whitespace-nowrap">Create at</th>
                    <th class="px-3 py-2 whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-center">
                <?php $users = getUsers() ?>
                <?php foreach ($users as $user): ?>
                    <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['id']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['first_name']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['last_name']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['birth_date']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['email']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['phone_number']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['profile_photo']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['user_type']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['status']) ?>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= htmlspecialchars( $user['created_at']) ?>
                        </td>
                        <!-- botones de table -->
                        <td class="px-3 py-2 whitespace-nowra">
                            <form action="">
                                <button class="rounded-lg bg-yellow-500 px-4 py-2 text-white">
                                    Modificar
                                </button>
                            </form>

                            <form action="">
                                <button class="rounded-lg bg-yellow-500 px-4 py-2 text-white">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>