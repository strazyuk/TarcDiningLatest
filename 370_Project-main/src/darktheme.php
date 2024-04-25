<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Design Plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        yellowPrimary: 'rgb(253 224 71)',
                        redSecondary: 'rgb(220 38 38)',
                        greenSecondary: 'rgb(34 197 94)',
                        darkBackground: 'rgb(17 24 39)',
                        darkText: 'rgb(209 213 219)',
                        darkAccent: 'rgb(79 70 229)',
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-white dark:bg-darkBackground text-black dark:text-darkText">
    <nav class="h-24 px-60 flex justify-between items-center bg-white dark:bg-darkBackground text-black dark:text-darkText">
        <div class="flex items-center">
            <img class="h-16 w-16" src="../ICON/logo.png" alt="Logo">
            <h1 class="text-3xl font-bold ml-3">UNIDining</h1>
        </div>
        <div class="flex items-center space-x-5">
            <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-house fa-rotate-by mr-2"></i>
                <a href="studentHome.php" class="text-xl font-semibold uppercase">Home</a>
            </div>
            <div class="flex items-center ml-5 hover:text-redSecondary">
                <i class="fa-solid fa-list mr-2"></i>
                <a href="menu.php" class="text-xl font-semibold uppercase">Menu</a>
            </div>
            <div class="flex items-center ml-5 hover:text-redSecondary">
                <i class="fa-solid fa-list-check mr-2"></i>
                <a href="student_feedback.php" class="text-xl font-semibold uppercase">Feedback</a>
            </div>
            <div class="flex items-center ml-5 hover:text-redSecondary">
                <i class="fa-solid fa-shopping-cart mr-2"></i>
                <a href="Buytoken.php" class="text-xl font-semibold uppercase">Buy Token</a>
            </div>
            <?php
            // Check if the user role is set in cookies
            if (isset($_COOKIE['role'])) {
                $role = $_COOKIE['role'];
                if ($role == 'student') {
                    echo "<div class='flex items-center ml-5 hover:text-redSecondary'>
                                <i class='fa-solid fa-shopping-cart mr-2'></i>
                                <a href='Cart.php' class='text-xl font-semibold uppercase'>Cart</a>
                            </div>";
                }
            }
            ?>
        </div>
        <div>
            <form action="search.php" method="post" class="flex items-center">
                <input type="text" name="search" placeholder="Search for food" class="px-3 py-1 border border-gray-300 rounded-md">
                <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 dark:bg-darkAccent dark:hover:bg-darkAccent-dark">Search</button>
            </form>
        </div>
        <div class="flex items-center space-x-5">
            <?php
            // Check if the user is logged in
            if (isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
                echo "<div class='flex items-center'>
                        <i class='fa-solid fa-user mr-2 text-2xl'></i>
                        <h1 class='text-xl font-semibold uppercase'>$username</h1>
                    </div>";
            }
            ?>
            <div class="flex items-center ml-2 hover:text-redSecondary">
                <a href="login.php" class="text-xl font-semibold uppercase bg-red-500 text-white rounded-md px-4 py-2 hover:bg-red-600 transition-colors duration-300">Logout</a>
            </div>
        </div>
    </nav>

    <main>
        <section class="h-80">
            <div class="bg-cover bg-center h-[30rem]" style="background-image: linear-gradient(to bottom right,rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2)),url(../ICON/banner.jpg);">
                <h1 class="text-7xl font-bold text-center py-10 text-white">Welcome to TarcDining</h1>
                <p class="text-center text-white text-lg">All-in-one solution for planning, organizing, and enjoying delicious meals effortlessly</p>
            </div>
        </section>
        <section>
            <div class="my-56 px-60">
                <h1 class="my-16 text-5xl font-extrabold text-center"><i class="fa-solid fa-chart-line text-5xl mr-4"></i>Trending Items</h1>
                <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30" slides-per-view="3">
                    <?php
                    require_once('DBconnect.php');
                    $useremail = $_COOKIE['email'];
                    $query = "SELECT * FROM curMenu WHERE status = 'published' ORDER BY sellcount DESC LIMIT 6";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $itemName = $row['name'];
                            $itemPrice = $row['token'];
                            $itemImage = $row['img'];
                            $itemType = $row['type'];
                            $itemID = $row['f_id'];
                    ?>
                            <swiper-slide onclick="handleForm('<?php echo $itemName; ?>', '<?php echo $itemPrice; ?>', '<?php echo $useremail; ?>', '<?php echo $itemID; ?>')">
                                <div class='w-72 h-96 rounded-lg relative' style='background-image: linear-gradient(to top,rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2)),url(<?php echo $itemImage; ?>); background-size: cover; background-repeat: no-repeat;'>
                                    <div class='absolute top-4 right-6'>
                                        <i class='fa-solid fa-cart-plus text-4xl text-white hover:text-[#FFBF00] hover pointer'></i>
                                    </div>
                                    <div class='flex flex-col justify-start absolute bottom-4 left-6'>
                                        <h1 class='text-3xl font-bold text-white'><?php echo $itemName; ?></h1>
                                        <div class='flex flex-row items-center'>
                                            <p class='text-white mr-4 flex items-center gap-2'><img class='w-4 h-4' src='../ICON/categories.png'><?php echo $itemType; ?></p>
                                            <p class='text-white flex items-center gap-2'><i class='fa-solid fa-dollar-sign'></i><?php echo $itemPrice; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </swiper-slide>
                    <?php
                        }
                    } else {
                        echo "Oops... No products found.";
                    }
                    ?>
                </swiper-container>
                <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
            </div>
            <div class="my-24 px-60">
                <h1 class="my-16 text-5xl font-extrabold text-center"><i class="fa-regular fa-calendar text-5xl mr-4"></i>Recently Added Items</h1>
                <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30" slides-per-view="3">
                    <?php
                    require_once('DBconnect.php');
                    $query = "SELECT * FROM curMenu WHERE status = 'published' ORDER BY created_at DESC LIMIT 6";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <swiper-slide onclick="handleForm('<?php echo $row['name']; ?>', '<?php echo $row['token']; ?>', '<?php echo $_COOKIE['email']; ?>', '<?php echo $row['f_id']; ?>')">
                                <div class='w-72 h-96 rounded-lg relative' style='background-image: linear-gradient(to top,rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2)),url(<?php echo $row['img']; ?>); background-size: cover; background-repeat: no-repeat;'>
                                    <div class='absolute top-4 right-6'>
                                        <i class='fa-solid fa-cart-plus text-4xl text-white hover:text-[#FFBF00] hover pointer'></i>
                                    </div>
                                    <div class='flex flex-col justify-start absolute bottom-4 left-6'>
                                        <h1 class='text-3xl font-bold text-white'><?php echo $row['name']; ?></h1>
                                        <div class='flex flex-row items-center'>
                                            <p class='text-white mr-4 flex items-center gap-2'><img class='w-4 h-4' src='../ICON/categories.png'><?php echo $row['type']; ?></p>
                                            <p class='text-white flex items-center gap-2'><i class='fa-solid fa-dollar-sign'></i><?php echo $row['token']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </swiper-slide>
                    <?php
                        }
                    } else {
                        echo "Oops... No products found.";
                    }
                    ?>
                </swiper-container>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
        </section>
    </main>
</body>

</html>
