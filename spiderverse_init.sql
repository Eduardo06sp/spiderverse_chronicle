CREATE DATABASE IF NOT EXISTS spiderverse_chronicle;
USE spiderverse_chronicle;

-- 1. Table: Eras
DROP TABLE IF EXISTS `eras`;
CREATE TABLE `eras` (
  `era_id` INT NOT NULL AUTO_INCREMENT,
  `decade` VARCHAR(20) NOT NULL,
  `summary` TEXT,
  PRIMARY KEY (`era_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Table: Characters
DROP TABLE IF EXISTS `characters`;
CREATE TABLE `characters` (
  `character_id` INT NOT NULL AUTO_INCREMENT,
  `era_id` INT,
  `name` VARCHAR(100) NOT NULL,
  `real_name` VARCHAR(100),
  `description` TEXT,
  PRIMARY KEY (`character_id`),
  FOREIGN KEY (`era_id`) REFERENCES `eras`(`era_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Table: Comic Covers
DROP TABLE IF EXISTS `comic_covers`;
CREATE TABLE `comic_covers` (
  `cover_id` INT NOT NULL AUTO_INCREMENT,
  `era_id` INT,
  `title` VARCHAR(255) NOT NULL,
  `issue` VARCHAR(50),
  `description` TEXT,
  `image_url` VARCHAR(255),
  PRIMARY KEY (`cover_id`),
  FOREIGN KEY (`era_id`) REFERENCES `eras`(`era_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Populating Data for ALL Eras
-- ==========================================

LOCK TABLES `eras` WRITE;
INSERT INTO `eras` (`decade`, `summary`) VALUES 
('1960s', 'The 1960s marked the birth of Spider-Man. Created by Stan Lee and Steve Ditko, Peter Parker first appeared in Amazing Fantasy #15 (1962). This era defined the core mythos: the spider bite, the tragic death of Uncle Ben, and the lesson that with great power comes great responsibility. It introduced key supporting characters and iconic villains that would challenge the wall-crawler for decades.'),
('1970s', 'The 1970s brought tragedy and maturity to Peter Parker''s life. The death of Gwen Stacy marked the end of the Silver Age of Comic Books, signaling darker storytelling. Spider-Man battled the Punisher, Morbius, and the Black Cat, while his relationship with Mary Jane Watson deepened amidst the grief.'),
('1980s', 'The 1980s introduced the iconic Black Suit (symbiote) which would eventually become Venom. The stories became grittier with ''Kraven''s Last Hunt'' and the introduction of the Hobgoblin. Peter Parker matured, marrying Mary Jane Watson in 1987, a major status quo shift.'),
('1990s', 'The 1990s were defined by the Clone Saga, seeing the return of Peter''s clone Ben Reilly (Scarlet Spider). The era was chaotic but introduced fan-favorites like Carnage and Spider-Man 2099. The artwork became more stylized, reflecting the ''extreme'' nature of 90s comics.'),
('2000s', 'The 2000s reinvented the mythos with the Ultimate Spider-Man universe, offering a modern take on Peter''s origins. In the main continuity, Peter joined the New Avengers, revealed his identity to the world during Civil War, and faced the controversial ''One More Day'' storyline which reset his marriage.'),
('2010s', 'The 2010s expanded the Spider-Verse significantly. The death of Ultimate Peter Parker led to the rise of Miles Morales. The ''Spider-Verse'' event introduced Spider-Gwen, Silk, and a multiverse of Spider-People. Peter became a global tech CEO in ''Parker Industries'' before returning to his roots.');
UNLOCK TABLES;

LOCK TABLES `characters` WRITE;
INSERT INTO `characters` (`era_id`, `name`, `real_name`, `description`) VALUES 
(1, 'Spider-Man', 'Peter Parker', 'A high school student bitten by a radioactive spider, gaining superhuman strength, agility, and the ability to cling to walls. Motivated by the death of his uncle, he fights crime while balancing a chaotic personal life.'),
(1, 'Uncle Ben', 'Ben Parker', 'Peter’s beloved uncle and father figure. His tragic death at the hands of a burglar Peter failed to stop serves as the catalyst for Spider-Man’s heroism.'),
(1, 'Aunt May', 'May Parker', 'Peter’s doting and somewhat fragile aunt. She raises Peter alone after Ben’s death, unaware of his secret identity.'),
(1, 'J. Jonah Jameson', 'J. Jonah Jameson', 'The blustering, Spider-Man-hating publisher of the Daily Bugle. He considers Spider-Man a menace and uses his paper to sway public opinion against him.'),
(1, 'Green Goblin', 'Norman Osborn', 'An industrialist driven insane by a strength-enhancing formula. He becomes Spider-Man’s archenemy, armed with pumpkin bombs and a goblin glider.'),
(1, 'Doctor Octopus', 'Otto Octavius', 'A brilliant nuclear physicist bonded with four mechanical tentacles in a lab accident. He is one of Spider-Man’s most intelligent and dangerous foes.'),
(2, 'Gwen Stacy', 'Gwen Stacy', 'Peter''s first true love. Her death at the hands of the Green Goblin is one of the most defining moments in Spider-Man history.'),
(2, 'Mary Jane Watson', 'Mary Jane Watson', 'The girl next door who becomes Peter''s confidante and eventual wife. Known for her catchphrase, "Face it, Tiger..."'),
(2, 'The Punisher', 'Frank Castle', 'A vigilante who initially targets Spider-Man, believing him to be a criminal. He uses lethal force in his war on crime.'),
(2, 'Black Cat', 'Felicia Hardy', 'A skilled cat burglar who has a complicated romantic relationship with Spider-Man, but is less interested in Peter Parker.'),
(2, 'Morbius', 'Michael Morbius', 'A biochemist turned into a "living vampire" after a failed experiment to cure his rare blood disease.'),
(3, 'Venom', 'Eddie Brock', 'A disgraced journalist who bonds with Spider-Man''s rejected alien costume to seek revenge on Peter Parker.'),
(3, 'Hobgoblin', 'Roderick Kingsley', 'A fashion designer who discovers Norman Osborn''s equipment and improves upon it to become a crime lord.'),
(3, 'Kingpin', 'Wilson Fisk', 'The Kingpin of Crime in NYC. While a Daredevil villain, he becomes a major antagonist for Spider-Man during this era.'),
(3, 'Madame Web', 'Cassandra Webb', 'A clairvoyant mutant who aids Spider-Man with her psychic powers, often guiding him through mystical threats.'),
(4, 'Carnage', 'Cletus Kasady', 'A serial killer who bonds with the offspring of the Venom symbiote, becoming a chaotic force of pure destruction.'),
(4, 'Scarlet Spider', 'Ben Reilly', 'A clone of Peter Parker created by the Jackal. He briefly takes over as Spider-Man during the Clone Saga.'),
(4, 'Spider-Man 2099', 'Miguel O''Hara', 'A geneticist from the future who gains spider-powers in a lab accident, fighting corrupt corporations in 2099.'),
(5, 'Morlun', 'Morlun', 'An ancient energy vampire who hunts Spider-Totems across the multiverse. He pushes Spider-Man to his absolute physical limits.'),
(5, 'Ultimate Spider-Man', 'Peter Parker (Earth-1610)', 'A younger, modern version of Peter Parker from the Ultimate Universe, whose stories reintroduced Spidey to a new generation.'),
(5, 'Ezekiel Sims', 'Ezekiel Sims', 'A man with spider-powers who reveals the mystical "totemic" nature of Spider-Man''s powers to Peter.'),
(6, 'Miles Morales', 'Miles Morales', 'A teenager from Brooklyn who takes up the mantle of Spider-Man after the death of Peter Parker in the Ultimate Universe.'),
(6, 'Spider-Gwen', 'Gwen Stacy (Earth-65)', 'A version of Gwen Stacy from an alternate universe who was bitten by the radioactive spider instead of Peter Parker.'),
(6, 'Silk', 'Cindy Moon', 'A girl bitten by the same spider as Peter Parker, who was locked away in a bunker for years to protect her from Morlun.');
UNLOCK TABLES;

LOCK TABLES `comic_covers` WRITE;
INSERT INTO `comic_covers` (`era_id`, `title`, `issue`, `description`, `image_url`) VALUES 
(1, 'Amazing Fantasy', '#15', 'The first appearance of Spider-Man. The cover features Spidey swinging with a criminal under his arm, introducing the world to the new hero.', 'assets/images/62_cover.jpg'),
(2, 'The Amazing Spider-Man', '#121', 'The Night Gwen Stacy Died. A somber cover announcing a "Turning Point" in Spider-Man''s life.', 'assets/images/73_cover.jpg'),
(2, 'The Amazing Spider-Man', '#129', 'First appearance of The Punisher. The cover features the Punisher taking aim at Spider-Man.', 'assets/images/75_cover.jpg'),
(3, 'The Amazing Spider-Man', '#252', 'First appearance of the Black Suit in the main title. Homage to Amazing Fantasy #15.', 'assets/images/88_cover.jpg'),
(3, 'The Amazing Spider-Man', '#300', 'First full appearance of Venom. Todd McFarlane''s iconic cover of Venom grinning.', 'assets/images/nov_87_cover.jpg'),
(3, 'The Amazing Spider-Man Annual', '#21', 'The Wedding of Spider-Man and Mary Jane. A joyous cover featuring the couple on their wedding day.', 'assets/images/oct_87_cover.jpg'),
(4, 'The Amazing Spider-Man', '#361', 'First full appearance of Carnage. Shows Carnage''s chaotic symbiote tendrils.', 'assets/images/90_cover.jpg'),
(4, 'Spider-Man 2099', '#1', 'Debut of the future Spider-Man. Foil cover featuring the futuristic suit design.', 'assets/images/92_cover.jpg'),
(4, 'Web of Spider-Man', '#118', 'Start of the Clone Saga key arcs. Features the Scarlet Spider (Ben Reilly).', 'assets/images/93_cover.jpg'),
(4, 'Web of Spider-Man', '#118', 'Start of the Clone Saga key arcs. Features the Scarlet Spider (Ben Reilly).', 'assets/images/94_and_95_cover.jpg'),
(5, 'Ultimate Spider-Man', '#1', 'The start of the Ultimate Universe. A modernized, younger Peter Parker unmasked.', 'assets/images/03_cover.jpg'),
(5, 'The Amazing Spider-Man', '#36', 'The 9/11 Tribute Issue. A black cover honoring the victims of the tragedy.', 'assets/images/06_and_07_cover.jpg'),
(5, 'The Amazing Spider-Man', '#583', 'Spider-Man meets President Obama. A special variant cover featuring Barack Obama.', 'assets/images/07_cover.jpg'),
(5, 'The Amazing Spider-Man', '#583', 'Spider-Man meets President Obama. A special variant cover featuring Barack Obama.', 'assets/images/08_cover.jpg'),
(6, 'Ultimate Fallout', '#4', 'First appearance of Miles Morales. Shows Miles holding the Spider-Man mask.', 'assets/images/10_cover.jpg'),
(6, 'Edge of Spider-Verse', '#2', 'First appearance of Spider-Gwen. Features Gwen Stacy in her distinctive hooded costume.', 'assets/images/13_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/14_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/15_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/19_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/april_18_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/dec_2012_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/july_18_cover.jpg'),
(6, 'The Amazing Spider-Man', '#700', 'Death of Peter Parker / Superior Spider-Man begins. A collage cover celebrating 700 issues.', 'assets/images/march_2012_cover.jpg');
UNLOCK TABLES;
