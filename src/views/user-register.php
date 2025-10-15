<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AVENTONES</title>
    <link rel="stylesheet" href="css/register.css" />
</head>

<body>
    <form class="registration-form" id="registration-form">
        <h2>User Registration</h2>
        <hr />
        <?php include COMP_PATH . '/toggle.php'; ?>

        <div class="registration-body">

            <div class="column-form">
                <div>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" />
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" />
                </div>
            </div>

            <div class="horizontal-form">
                <div>
                    <label for="user-id">Id</label>
                    <input type="text" id="user-id" />
                </div>
            </div>

            <div class="column-form">
                <div>
                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" />
                </div>
            </div>

            <div class="horizontal-form">
                <div>
                    <label for="phone-number">Phone Number</label>
                    <input type="text" id="phone-number" />
                </div>
            </div>
        </div>

        <div class="horizontal-form">
            <div>
                <label for="personal-photo">Fotografia personal</label>
                <input type="text" id="personal-photo" />
            </div>
        </div>

        <div class="column-form">
            <div>
                <label for="register-password">Password</label>
                <input type="password" id="register-password" />
            </div>
            <div>
                <label for="repeat-password">Repeat Password</label>
                <input type="password" id="repeat-password" />
            </div>
        </div>

        <section class="cta-button">
            <div class="cta-buttons-sign-up">
                <button type="submit">Sign up</button>
            </div>
        </section>

    </form>

</body>
</html>