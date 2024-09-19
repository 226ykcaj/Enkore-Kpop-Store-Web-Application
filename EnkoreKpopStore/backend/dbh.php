<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "enkore kpop store";
// to connect to the server
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the database if it doesn't exist
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$dBName`
    DEFAULT CHARACTER SET utf32
    DEFAULT COLLATE utf32_general_ci;";

if (!mysqli_query($conn, $sqlCreateDB) !== false) {
    die("Error creating database: " . mysqli_error($conn));
}

// Connect to the database
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create tables if they don't exist
$sqlToCreateUserTable = "CREATE TABLE IF NOT EXISTS users (
    usersId INT(11) AUTO_INCREMENT PRIMARY KEY,
    usersEmail VARCHAR(255) NOT NULL,
    usersName VARCHAR(255),
    address VARCHAR(255),
    usersPhone VARCHAR(255),
    usersPassword VARCHAR(255) NOT NULL
);";


if (!mysqli_query($conn, $sqlToCreateUserTable)) {
    die("Error creating users table: " . mysqli_error($conn));
}

$sqlToCreateProductTable = "CREATE TABLE IF NOT EXISTS products (
    productId INT(11) PRIMARY KEY NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(7,2) NOT NULL,
    quantity INT(11) NOT NULL,
    img_album VARCHAR(255) NOT NULL,
    img_desc VARCHAR(255) NOT NULL,
    img_group VARCHAR(255) NOT NULL,
    categoryId INT(11) NOT NULL
);";

if (!mysqli_query($conn, $sqlToCreateProductTable)) {
    die("Error creating products table: " . mysqli_error($conn));
}

$sqlToCreateCartTable = "CREATE TABLE IF NOT EXISTS cart (
    cartId INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    productId INT(11) NOT NULL,
    usersId INT(11) NOT NULL,
    product_name TEXT NOT NULL,
    price DECIMAL(7,2) NOT NULL,
    quantity INT(11) NOT NULL,
    img_album VARCHAR(255) NOT NULL,
    payment_status VARCHAR(255),
    CONSTRAINT fk_users_id FOREIGN KEY (usersId) REFERENCES users(usersId),
    CONSTRAINT fk_product_id FOREIGN KEY (productId) REFERENCES products(productId)
);";

if (!mysqli_query($conn, $sqlToCreateCartTable)) {
    die("Error creating cart table: " . mysqli_error($conn));
}

// to check if products table already have data
$sqlToCheckProduct = "SELECT * FROM products";

$resultOfProducts = mysqli_query($conn, $sqlToCheckProduct);

if (!$resultOfProducts) {
    die("Fail to select data from products:" . mysqli_error($conn));
}

// to insert products details if there is no data in products table
if (mysqli_num_rows($resultOfProducts) <= 0) {
$sqlToInsertProduct = 
"INSERT INTO products (productId, name, description, price, quantity, img_album, img_desc, img_group, categoryId) VALUES
(1,'LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Kim Chaewon ver.]','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
<br><p>LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Kim Chaewon ver.]</p>
<br><p>[Release date : Feb 19th, 2024]</p>
<br><p>[Album Information & Contents]</p>
<ul>
<li>OUT HOLDER : EACH RANDOM 1EA OF 5EA / W170 X H240 X T9 (mm)</li>
<li>PHOTOBOOK : EACH RANDOM 1EA OF 5EA / W165 X H235 (mm) / 16 pages</li>
<li>CD-R : 1EA / W120 X H120 (mm)</li>
<li>PHOTOCARD : EACH RANDOM 1EA OF 5EA / W55 X H85 (mm)</li>
<li>POSTCARD : EACH RANDOM 1EA OF 5EA / W160 X H110 (mm)</li>
<li>LYRIC PAPER : 1EA / W105 X H148 (mm)</li>
</ul>
<br>
<p>[Track List]</p>
<ol>
<li>Good Bones</li>
<li>Easy</li>
<li>Swan Song</li>
<li>Smart</li>
<li>We got so much</li>
</ol>', 70, 50, '<img src=\"picture/lesserafim/easy/chaewon.jpeg\" alt=\"LESSERAFIM Chaewon Easy Album Image\">', 
'<img src=\"picture/lesserafim/easy/product-desc.jpg\" alt=\"LESSERAFIM Chaewon Easy Album Description\">',
'<img src=\"picture/lesserafim/group-photo.jpg\" alt=\"Group photo\">',1),

(2,'LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Hong Eunchae ver.]','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
<br>
<p>LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Hong Eunchae ver.]</p>
<br>
<p>[Release date : Feb 19th, 2024]</p>
<br>
<p>[Album Information & Contents]</p>
<ul>
    <li>OUT HOLDER : EACH RANDOM 1EA OF 5EA / W170 X H240 X T9 (mm)</li>
    <li>PHOTOBOOK : EACH RANDOM 1EA OF 5EA / W165 X H235 (mm) / 16 pages</li>
    <li>CD-R : 1EA / W120 X H120 (mm)</li>
    <li>PHOTOCARD : EACH RANDOM 1EA OF 5EA / W55 X H85 (mm)</li>
    <li>POSTCARD : EACH RANDOM 1EA OF 5EA / W160 X H110 (mm)</li>
    <li>LYRIC PAPER : 1EA / W105 X H148 (mm)</li>
</ul>
<br>
<p>[Track List]</p>
<ol>
    <li>Good Bones</li>
    <li>Easy</li>
    <li>Swan Song</li>
    <li>Smart</li>
    <li>We got so much</li>
</ol>',70,50, '<img src=\"picture/lesserafim/easy/eunchae.jpeg\" alt=\"LESSERAFIM Eunchae Easy Album Image\">',
'<img src=\"picture/lesserafim/easy/product-desc.jpg\" alt=\"LESSERAFIM Eunchae Easy Album Description\">',
'<img src=\"picture/lesserafim/group-photo.jpg\" alt=\"Group photo\">',1),

(3,'LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Kazuha ver.]','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Kazuha ver.]</p>
            <br>
            <p>[Release date : Feb 19th, 2024]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>OUT HOLDER : EACH RANDOM 1EA OF 5EA / W170 X H240 X T9 (mm)</li>
                <li>PHOTOBOOK : EACH RANDOM 1EA OF 5EA / W165 X H235 (mm) / 16 pages</li>
                <li>CD-R : 1EA / W120 X H120 (mm)</li>
                <li>PHOTOCARD : EACH RANDOM 1EA OF 5EA / W55 X H85 (mm)</li>
                <li>POSTCARD : EACH RANDOM 1EA OF 5EA / W160 X H110 (mm)</li>
                <li>LYRIC PAPER : 1EA / W105 X H148 (mm)</li>
            </ul>
            <br>
            <p>[Track List]</p>
            <ol>
                <li>Good Bones</li>
                <li>Easy</li>
                <li>Swan Song</li>
                <li>Smart</li>
                <li>We got so much</li>
            </ol>',70,50, '<img src=\"picture/lesserafim/easy/kazuha.jpeg\" alt=\"LESSERAFIM Kazuha Easy Album Image\">',
            '<img src=\"picture/lesserafim/easy/product-desc.jpg\" alt=\"LESSERAFIM Kazuha Easy Album Description\">',
            '<img src=\"picture/lesserafim/group-photo.jpg\" alt=\"Group photo\">',1),
            
(4,'LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Sakura ver.]','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>LE SSERAFIM - 3rd Mini Album EASY (COMPACT Ver.) [Sakura ver.]</p>
            <br>
            <p>[Release date : Feb 19th, 2024]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>OUT HOLDER : EACH RANDOM 1EA OF 5EA / W170 X H240 X T9 (mm)</li>
                <li>PHOTOBOOK : EACH RANDOM 1EA OF 5EA / W165 X H235 (mm) / 16 pages</li>
                <li>CD-R : 1EA / W120 X H120 (mm)</li>
                <li>PHOTOCARD : EACH RANDOM 1EA OF 5EA / W55 X H85 (mm)</li>
                <li>POSTCARD : EACH RANDOM 1EA OF 5EA / W160 X H110 (mm)</li>
                <li>LYRIC PAPER : 1EA / W105 X H148 (mm)</li>
            </ul>
            <br>
            <p>[Track List]</p>
            <ol>
                <li>Good Bones</li>
                <li>Easy</li>
                <li>Swan Song</li>
                <li>Smart</li>
                <li>We got so much</li>
            </ol>',70,50, '<img src=\"picture/lesserafim/easy/sakura.jpeg\" alt=\"LESSERAFIM Sakura Easy Album Image\">',
            '<img src=\"picture/lesserafim/easy/product-desc.jpg\" alt=\"LESSERAFIM Sakura Easy Album Description\">',
            '<img src=\"picture/lesserafim/group-photo.jpg\" alt=\"Group photo\">',1),
(5,'iKON - iKON 2024 Season Greeting (KON HOUSE)','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>iKON - iKON 2024 Season Greeting (KON HOUSE)</p>
            <br>
            <p>[Release date : Dec 26th, 2023]</p>
            <br>
            <p>[Photobook Information & Contents]</p>
            <ul>
                <li>Outbox</li>
                <li>Dual Calender</li>
                <li>Photobox</li>
                <li>Diary</li>
                <li>Poster Set</li>
                <li>Character File Set</li>
                <li>Calendar Photocard Set</li>
                <li>Scrunchie</li>
                <li>Photocard Set</li>
                <li>Phone Strap</li>
            </ul>',200,50,'<img src=\"picture/ikon/ikon-2024-season-greeting/album.jpg\" alt=\"iKON Season Greeting Album Image\">',
            '<img src=\"picture/ikon/ikon-2024-season-greeting/product-desc.jpg\" alt=\"iKON Season Greeting Album Description\">',
            '<img src=\"picture/ikon/group-photo.jpg\" alt=\"Group photo\">',2),
(6,'iKON - iKON\\'s The DreamPing PHOTOBOOK','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>iKON - iKON\\'s The DreamPing PHOTOBOOK</p>
            <br>
            <p>[Release date : Oct 26th, 2023]</p>
            <br>
            <p>[Photobook Information & Contents]</p>
            <ul>
                <li>Photobook</li>
                <li>Folded Poster Set</li>
                <li>2 Cut Photo</li>
                <li>Photocard</li>
            </ul>',150,50,'<img src=\"picture/ikon/ikon_s-the-dreamping-photobook/album.jpg\" alt=\"iKON Dreamping Photobook Album Image\">',
            '<img src=\"picture/ikon/ikon_s-the-dreamping-photobook/product-desc.jpg\" alt=\"iKON Dreamping Photobook Album Description\">',
            '<img src=\"picture/ikon/group-photo.jpg\" alt=\"Group photo\">',2),
(7,'iKON - FLASHBACK KiT','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>iKON - FLASHBACK KiT</p>
            <br>
            <p>[Release date : May 10th, 2022]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>Version : 6 Versions [Each Member]</li>
                <li>Package Box + Random KiT</li>
                <li>Title Card Set</li>
                <li>Lyrics Photocard Set</li>
                <li>Sticker</li>
                <li>Random Folded Photo</li>
            </ul>',70,50,'<img src=\"picture/ikon/ikon-flashback-kit-album/album.jpg\" alt=\"iKON Flashback Kit Album Image\">',
            '<img src=\"picture/ikon/ikon-flashback-kit-album/product-desc.jpg\" alt=\"iKON Flashback Kit Album Description\">',
            '<img src=\"picture/ikon/group-photo.jpg\" alt=\"Group photo\">',2),
(8,'iKON - Official Light Stick VER.2023','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>iKON - Official Light Stick VER.2023</p>
            <br>
            <p>[Release date : May 12th, 2023]</p>
            <br>
            <p>[Light Stick Information & Contents]</p>
            <ul>
                <li>Out Box</li>
                <li>Light Stick</li>
                <li>Strap</li>
                <li>Warranty</li>
            </ul>',250,50,'<img src=\"picture/ikon/ikon-light-stick/lightstick.jpg\" alt=\"iKON Lightstick image\">',
            '<img src=\"picture/ikon/ikon-light-stick/product-desc.jpg\" alt=\"iKON Lightstick Description\">',
            '<img src=\"picture/ikon/group-photo.jpg\" alt=\"Group photo\">',2),
(9,'NewJeans - Get Up 2nd EP The POWERPUFF GIRLS X NJ BOX Ver.','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>NewJeans - Get Up 2nd EP The POWERPUFF GIRLS X NJ BOX Ver.</p>
            <br>
            <p>[Release date : July 21st, 2023]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>2 Versions ( A Ver./ B Ver.)</li>
                <li>Photobook</li>
                <li>Lyrics</li>
                <li>Outbox</li>
                <li>Postcard</li>
                <li>Bookmark</li>
                <li>Sticker</li>
                <li>Photocard</li>
                <li>CD-R</li>
            </ul>
            <br>
            <p>[Track List]</p>
            <ol>
                <li>New Jeans</li>
                <li>Super Shy</li>
                <li>ETA</li>
                <li>Cool With You</li>
                <li>Get Up</li>
                <li>ASAP</li>
            </ol>',90,50,'<img src=\"picture/newjeans/newjeans-get up/album.jpg\" alt=\"NewJeans - Get Up 2nd EP The POWERPUFF GIRLS X NJ BOX Ver. Album Image\">',
            '<img src=\"picture/newjeans/newjeans-get up/product-desc.jpg\" alt=\"NewJeans - Get Up 2nd EP The POWERPUFF GIRLS X NJ BOX Ver. Album Description\">',
            '<img src=\"picture/newjeans/group-photo.jpg\" alt=\"Group photo\">',3),
(10,'New Jeans (Weverse Albums ver.)','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>New Jeans (Weverse Albums ver.)</p>
            <br>
            <p>[Release date : Aug 8th, 2022]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>Lyrics</li>
                <li>Photocard</li>
                <li>QR Card</li>
            </ul>
            <br>
            <p>[Track List]</p>
            <ol>
                <li>Attention</li>
                <li>Hype Boy</li>
                <li>Cookie</li>
                <li>Hurt</li>
            </ol>',70,50,'<img src=\"picture/newjeans/newjeans/album.jpg\" alt=\"New Jeans (Weverse Albums ver.) Album Image\">',
            '<img src=\"picture/newjeans/newjeans/product-desc.jpeg\" alt=\"New Jeans (Weverse Albums ver.) Album Description\">',
            '<img src=\"picture/newjeans/group-photo.jpg\" alt=\"Group photo\">',3),
(11,'NewJeans Yearbook 22-23','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>NewJeans Yearbook 22-23</p>
            <br>
            <p>[Release date : Nov 10th, 2022]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>Lyrics</li>
                <li>Photocard</li>
                <li>QR Card</li>
                <li>Outbox</li>
                <li>Photo Bundle</li>
                <li>Bunnies Camp Photobook</li>
                <li>Bunnies Camp Handbook</li>
                <li>Letters to Bunnies</li>
                <li>Polaroid Book</li>
                <li>Photo Zine</li>
                <li>Photocards</li>
                <li>Photosticker pack</li>
                <li>Digital Code Card</li>
                <li>Index sticker</li>
            </ul>',300,50,'<img src=\"picture/newjeans/newjeans yearbook 22-23/album.jpg\" alt=\"Newjeans Yearbook 22-23 Album Image\">',
            '<img src=\"picture/newjeans/newjeans yearbook 22-23/product-desc.jpg\" alt=\"Newjeans Yearbook 22-23 Album Description\">',
            '<img src=\"picture/newjeans/group-photo.jpg\" alt=\"Group photo\">',3),
(12,'NewJeans - 2024 Season\\'s Greetings [24/7 With NEWJEANS]','<p>*Out box is to only protect contents inside therefore out box damage cannot be a reason for a return or exchange. Please take an un-boxing video in case of defective or missing contents inside.</p>
            <br>
            <p>NewJeans - 2024 Season\\'s Greetings [24/7 With NEWJEANS]</p>
            <br>
            <p>[Release date : Dec 18th, 2023]</p>
            <br>
            <p>[Album Information & Contents]</p>
            <ul>
                <li>Outbox</li>
                <li>Desk Calendar</li>
                <li>Exposed Binding Diary</li>
                <li>Hand Book</li>
                <li>Year Poster</li>
                <li>Mini Poster</li>
                <li>Photo Frame Keyring</li>
                <li>ID Portrait Set</li>
                <li>Weekly Challenge Cards</li>
                <li>Digital Code Se</li>
                <li>Sticker</li>
            </ul>',200,50,'<img src=\"picture/newjeans/newjeans-2024 season_s greetings/album.jpg\" alt=\"Newjeans 2024 Seasons Greeting Album Image\">',
            '<img src=\"picture/newjeans/newjeans-2024 season_s greetings/product-desc.png\" alt=\"Newjeans 2024 Seasons Greeting Album Description\">',
            '<img src=\"picture/newjeans/group-photo.jpg\" alt=\"Group photo\"',3);";

    if (!mysqli_query($conn, $sqlToInsertProduct)) {
        die("Fail to insert product to database:" . mysqli_error($conn));
    }
}
// to free result
mysqli_free_result($resultOfProducts);