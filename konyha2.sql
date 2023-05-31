DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS user_recipes;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS recipes (
  recipe_id INT AUTO_INCREMENT PRIMARY KEY,
  recipe_name VARCHAR(255) NOT NULL,
  ingredients VARCHAR(500) NOT NULL,
  preparation_time INT NOT NULL,
  cooking_time INT NOT NULL,
  serving_size INT NOT NULL,
  instructions TEXT NOT NULL,
  recipe_image VARCHAR(255) NOT NULL,
  mealtime ENUM('breakfast','dinner','lunch') NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  userpassword VARCHAR(255) NOT NULL,
  useremail VARCHAR(255) NOT NULL,
  user_type ENUM('guest', 'common', 'admin') NOT NULL DEFAULT 'common'
);

CREATE TABLE IF NOT EXISTS user_recipes (
  user_id INT,
  recipe_id INT,
  PRIMARY KEY (user_id, recipe_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
);
 
CREATE TABLE IF NOT EXISTS favorites (
  user_id INT,
  recipe_id INT,
  PRIMARY KEY (user_id, recipe_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
);

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Gulyásleves', 'marhahús, hagyma, paprika, burgonya', 15, 120, 4, '1. Vágjuk fel a húst és a hagymát. 2. Pirítsuk meg a hagymát egy lábasban. 3. Adjuk hozzá a húst és pirítsuk meg. 4. Szórjuk rá a pirospaprikát. 5. Öntsük fel vízzel és főzzük lassú tűzön 2 órán keresztül. 6. Adjuk hozzá a kockázott burgonyát és főzzük további 30 percig. 7. Tálaljuk.', 'gulyasleves.jpg', 'lunch');

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Túrós csusza', 'csusza tészta, túró, tejföl, szalonna, hagyma', 10, 30, 4, '1. Főzzük meg a csusza tésztát. 2. Pirítsuk meg a szalonnát és a hagymát. 3. Keverjük össze a túrót a tejföllel. 4. Keverjük össze a tésztát, a szalonnát, a hagymát és a túró-tejföl keveréket. 5. Tálaljuk.', 'turoscsusza.jpg', 'dinner');

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Somlói galuska', 'gomba galuska, csokoládé, vanília puding, rum, dió, tejszínhab', 15, 60, 6, '1. Készítsünk gomba galuskát. 2. Készítsünk vanília pudingot és csokoládé pudingot. 3. Áztassuk be a gomba galuskát rummal. 4. Rétegezzük a beáztatott galuskát, a vanília pudingot, a csokoládé pudingot és a diót. 5. Díszítsük tejszínhabbal.','somloigaluska.jpg', 'lunch');

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Túrós Palacsinta', 'liszt, tojás, tej, túró, cukor', 15, 30, 2, '1. Készítsünk palacsintatésztát a liszt, tojás és tej felhasználásával. 2. Keverjük össze a túrót cukorral. 3. Töltjük meg a palacsintákat a túrós töltelékkel. 4. Tekerjük fel a palacsintákat és tegyük sütőbe 180°C-on 15 percig. 5. Tálaljuk melegen.', 'turospalacsinta.jpg', 'breakfast');

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Rakott Krumpli', 'krumpli, sonka, sajt, tejföl', 45, 60, 6, '1. Főzzük meg a krumplit sós vízben, majd vágjuk fel karikákra. 2. Rakjunk egy réteg krumplit egy kiolajozott tűzálló tál aljára. 3. Rakjunk rá egy réteg sonkát és reszelt sajtot. 4. Ismételjük meg a rétegezést, amíg elfogy a hozzávalók. 5. Öntsük rá a tejfölt, majd szórjunk rá reszelt sajtot. 6. Süssük 180°C-on 45-60 percig, amíg aranybarnára sül. 7. Tálaljuk melegen.', 'rakottkrumpli.jpg', 'lunch');

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Bundás Kenyér', 'kenyér, tojás, főzőtejszin, só, napraforgó olaj', 5, 15, 4, '1. Tegyük fel az olajat lassan melegedni egy serpenyőben. 2. Verjük fel a tojásokat a tejszínnel és a sóval. 3. Mártsuk bele mindkét oldalát a tojásba. 4. Süssük 170-180 fokon pár percig mindkét oldalát, amíg szép aranybarna lesz. 5. Az elkészült bundáskenyereket szedjük ki, és csepegtessük le egyből papírtörlőn.', 'bundaskenyer.jpg', 'dinner');

INSERT INTO recipes (recipe_name, ingredients, preparation_time, cooking_time, serving_size, instructions, recipe_image, mealtime)
VALUES ('Rántott Hús', 'sertés rövidkaraj, finomliszt, zsemlemorzsa, tojás, só-bors, napraforgó olaj', 15, 15, 2, '1. A sertéskarajokat megmossuk, konyhakész állapotba hozzuk és kiklopfoljuk. 2. ízlés szerint sózzuk, borsozzuk 3. A szeleteket először a lisztbe forgatjuk bele. Kicsit lerázzuk, majd beletesszük a tojásba. Ha mindenhol befedte a tojás, akkor a zsemlemorzsába is beleforgatjuk. 4. Forró olajban, közepes lángon minkét oldalukat megsütjük', 'rantotthus.jpg', 'lunch');

INSERT INTO users (username, userpassword, useremail, user_type) 
VALUES ('admin', '$2y$10$Sr0Bn9.KJ.m9CWxyWwf7xOt9uUiYMxcnugIdqNy9XpfcORa3m6mLS', 'admin@gmail.com', 'admin');

INSERT INTO favorites (user_id, recipe_id) VALUES (1, 1);


SELECT u.username, r.recipe_name AS favorite_recipe
FROM users u
JOIN favorites f ON u.user_id = f.user_id
JOIN recipes r ON f.recipe_id = r.recipe_id
WHERE u.username = 'johndoe';

SELECT r.recipe_name AS favorite_dish
FROM favorites f
JOIN recipes r ON f.recipe_id = r.recipe_id
JOIN users u ON f.user_id = u.user_id
WHERE u.username = 'johndoe';

SELECT * FROM users;

SELECT * FROM recipes; 
SELECT * FROM user_recipes; /*jo */

SELECT * FROM favorites; /* jo */


              
              

