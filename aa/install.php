<?php

require("constants.php");

$db_name = DB_NAME;//"getOnlineMovie.db";
$db = new SQLite3($db_name);


/**
   * Creates a new database and initializes all the tables
   * Should be called at the very start of the website
   */

function init($db) {
  try{
    $query = "DROP TABLE IF EXISTS director";
    $db->exec($query);
    $query = "CREATE TABLE director (
  				id INTEGER PRIMARY KEY,
  				first_name TEXT,
  				last_name TEXT)";
    $db->exec($query);
    $query = "INSERT INTO director(first_name,last_name) VALUES('Anthony','Russo');".
              "INSERT INTO director(first_name,last_name) VALUES('John','Behring');".
              "INSERT INTO director(first_name,last_name) VALUES('Seth','Gordon');".
              "INSERT INTO director(first_name,last_name) VALUES('Chris','Sun');".
              "INSERT INTO director(first_name,last_name) VALUES('James','Wan');".
              "INSERT INTO director(first_name,last_name) VALUES('David','Kerr');".
              "INSERT INTO director(first_name,last_name) VALUES('David','Lowery');".
              "INSERT INTO director(first_name,last_name) VALUES('Steven','Caple Jr.');".
              "INSERT INTO director(first_name,last_name) VALUES('Jeff','Wadlow');".
              "INSERT INTO director(first_name,last_name) VALUES('Roar','Uthaug');".
              "INSERT INTO director(first_name,last_name) VALUES('Michael','Gracey');".
              "INSERT INTO director(first_name,last_name) VALUES('Matthew','Heineman');";
    $db->exec($query);


    $query = "DROP TABLE IF EXISTS actor";
    $db->exec($query);
    $query = "CREATE TABLE actor (
  				id INTEGER PRIMARY KEY,
  				name TEXT,
  				dob TEXT,
          profile_image TEXT,
          intro TEXT)";
    $db->exec($query);
    $query = "INSERT INTO actor(name,dob,profile_image,intro) VALUES('Robert Downey Jr.','1965-04-04','images/actors/robert.jpg','Downey was born April 4, 1965 in Manhattan, New York, the son of writer, director and filmographer Robert Downey Sr. and actress Elsie Downey (née Elsie Ann Ford). Robert father is of half Lithuanian Jewish, one quarter Hungarian Jewish, and one quarter Irish, descent, while Robert mother was of English, Scottish, German, and Swiss-German ancestry. Robert and his sister, Allyson Downey, were immersed in film and the performing arts from a very young age, leading Downey Jr. to study at the Stagedoor Manor Performing Arts Training Center in upstate New York, before moving to California with his father following his parents 1978 divorce. In 1982, he dropped out of Santa Monica High School to pursue acting full time. Downey Sr., himself a drug addict, exposed his son to drugs at a very early age, and Downey Jr. would go on to struggle with abuse for decades.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Chris Hemsworth','1983-08-11','images/actors/chris.jpg','Chris saw quite a bit of the country in his youth, after his family moved to the Northern Territory before finally settling on Phillip Island, to the south of Melbourne. In 2004, he unsuccessfully auditioned for the role of Robbie Hunter in the Australian soap opera Home and Away (1988) but was recalled for the role of Kim Hyde which he played until 2007. In 2006, he entered the Australian version of Dancing with the Stars (2004) and his popularity in the soap enabled him to hang on until show 7 (Dancing with the Stars: Episode #5.7 (2006) when he became the fifth contestant to be eliminated.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Mark Ruffalo','1967-11-22','images/actors/mark.jpg','Mark Ruffalo was born in Kenosha, Wisconsin, to Marie Rose (Hebert), a stylist and hairdresser, and Frank Lawrence Ruffalo, a construction painter. His father''s ancestry is Italian, and his mother is of half French-Canadian and half Italian descent. Mark moved with his family to Virginia Beach, Virginia, where he lived out most of his teenage years. Following high school, Mark moved with his family to San Diego and soon migrated north, eventually settling in Los Angeles. He took classes at the Stella Adler Conservatory and subsequently co-founded the Orpheus Theatre Company, an Equity-Waiver establishment, where he worked in nearly every capacity. From acting, writing, directing and producing to running the lights and building sets while building his resume. Bartending for nearly nine years to make ends meet and ready to give it all up, a chance meeting and resulting collaboration with playwright/screenwriter Kenneth Lonergan changed everything.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Chris Evans','1981-06-13','images/actors/chris_evans.jpg','He was born in Boston, Massachusetts, the son of Lisa (Capuano), who worked at the Concord Youth Theatre, and G. Robert Evans III, a dentist. His uncle is congressman Mike Capuano. Chris''s father is of half German and half Welsh/English/Scottish ancestry, while Chris''s mother is of half Italian and half Irish descent. He has an older sister, Carly Evans, and two younger siblings, a brother named Scott Evans, who is also an actor, and a sister named Shana Evans. The family moved to suburban Sudbury when he was 11 years-old. Bitten by the acting bug in the first grade because his older sister, Carly, started performing, Evans followed suit and began appearing in school plays. While at Lincoln-Sudbury Regional High School, his drama teacher cited his performance as Leontes in The Winters Tale as exemplary of his skill. After more plays and regional theatre, he moved to New York and attended the Lee Strasberg Theatre Institute.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Scarlett Johansson','1984-11-22','images/actors/scarlett_johansson.jpg','Johansson began acting during childhood, after her mother started taking her to auditions. She made her professional acting debut at the age of eight in the off-Broadway production of ''Sophistry'' with Ethan Hawke, at New York''s Playwrights Horizons. She would audition for commercials but took rejection so hard her mother began limiting her to film tryouts. She made her film debut at the age of nine, as John Ritter''s character''s daughter in the fantasy comedy North (1994). Following minor roles in Just Cause (1995), as the daughter of Sean Connery and Kate Capshaw''s character, and If Lucy Fell (1996), she played the role of Amanda in Manny & Lo (1996). Her performance in Manny & Lo garnered a nomination for the Independent Spirit Award for Best Lead Female, and positive reviews, one noting, [the film] grows on you, largely because of the charm of ... Scarlett Johansson, while San Francisco Chronicle critic Mick LaSalle commentated on her peaceful aura, and wrote, If she can get through puberty with that aura undisturbed, she could become an important actress.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Hugh Jackman','1968-10-12','images/actors/hugh_jackman.jpg','Hugh Michael Jackman is an Australian actor, singer, multi-instrumentalist, dancer and producer. Jackman has won international recognition for his roles in major films, notably as superhero, period, and romance characters. He is best known for his long-running role as Wolverine in the X-Men film series, as well as for his lead roles in the romantic-comedy fantasy Kate &amp; Leopold (2001), the action-horror film Van Helsing (2004), the drama The Prestige and The Fountain (2006), the epic historical romantic drama Australia (2008), the film version of Les Misérables (2012), and the thriller Prisoners (2013). His work in Les Misérables earned him his first Academy Award nomination for Best Actor and his first Golden Globe Award for Best Actor - Motion Picture Musical or Comedy in 2013. In Broadway theatre, Jackman won a Tony Award for his role in The Boy from Oz. A four-time host of the Tony Awards themselves, he won an Emmy Award for one of these appearances. Jackman also hosted the 81st Academy Awards on 22 February 2009.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Michelle Williams','1980-09-09','images/actors/michelle_williams.jpg','A small-town girl born and raised in rural Kalispell, Montana, Michelle Ingrid Williams is the daughter of Carla Ingrid (Swenson), a homemaker, and Larry Richard Williams, a commodity trader and author. Her ancestry is Norwegian, as well as German, British Isles, and other Scandinavian. She was first known as bad girl Jen Lindley in the television series Dawson''s Creek (1998). She appeared in the comedy film Dick (1999), which was a parody of the Watergate Scandal along with Kirsten Dunst, as well as Prozac Nation (2001) with Christina Ricci. Since then, Michelle has worked her way into the world of independent films such as The Station Agent (2003), Imaginary Heroes (2004), and The Baxter (2005). But her real success happened in 2005 when she starred in Ang Lee''s Brokeback Mountain (2005) as Alma Beers Del Mar. A woman who realizes her husband is in love with another man. Her talent shown in Brokeback Mountain (2005) landed her an Academy Award nomination for Best Supporting Actress. In 2011, she received her first lead role Academy Award nomination for Blue Valentine (2010). She followed this in 2012 with a lead role Academy Award nomination for My Week with Marilyn (2011).');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Zac Efron','1987-10-18','images/actors/zac_efron.jpg','Zachary David Alexander Efron was born October 18, 1987 in San Luis Obispo, California, to Starla Baskett, a secretary, and David Efron, an electrical engineer. He has a younger brother, Dylan. The surname \"Efron\", which is Hebrew and a Biblical place name, comes from Zac''s Polish Jewish paternal grandfather.\nZac was raised in Arroyo Grande, CA. He took his first step toward acting at the age of eleven, after his parents noticed his singing ability. Singing and acting lessons soon led to an appearance in a production of \"Gypsy\" that ran 90 performances, and he was hooked. After appearing on-stage in \"Peter Pan\", \"Auntie Mame\", \"Little Shop of Horrors\" and \"The Music Man\", guest parts quickly followed on television series, including Firefly (2002), ER (1994), CSI: Miami (2002), NCIS (2003), and The Guardian (2001). After guest-starring in several episodes of Summerland (2004), Zac joined the regular cast as girl-crazy Cameron Bale. He also starred in several pilots, such as The Big Wide World of Carl Laemke (2003) and Triple Play (2004), and played an autistic child in the television film The Unexpected Journey (2004), alongside Mary-Louise Parker and Aidan Quinn. He graduated from Arroyo Grande High School in June 2006.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Zendaya','1996-09-01','images/actors/zendaya.jpg','Zendaya (which means \"to give thanks\" in the language of Shona) is an American actress and singer born in Oakland, California. She began her career appearing as a child model working for Macy''s, Mervyns and Old Navy. She was a backup dancer before gaining prominence for her role as Rocky Blue on the Disney Channel sitcom Shake It Up (2010) which also includes Bella Thorne, Kenton Duty and Roshon Fegan. Zendaya was a contestant on the sixteenth season of the competition series Dancing with the Stars. She went on to produce and star as K.C. Cooper in the Disney Channel sitcom K.C. Undercover (2015) She made her film breakthrough in 2017, starring as Michelle \"MJ\" Jones in the Marvel Cinematic Universe superhero film Spider-Man Homecoming (2017) and as Anne Wheeler in the musical drama film The Greatest Showman (2017) alongside actors such as Tom Holland, Hugh Jackman and Zac Efron. Besides acting, singing and dancing she is an ambassador for Convoy of Hope. She has written a book, launched her own clothing line (Daya by Zendaya) and proved herself to be a great role model for young girls all around the world.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Rebecca Ferguson','1983-10-19','images/actors/rebecca_ferguson.jpg','Rebecca Ferguson was born Rebecca Louisa Ferguson Sundström in Stockholm, Sweden, and grew up in its Vasastaden district. Her father is Swedish. Her mother, Rosemary Ferguson, is British, of Scottish and Northern Irish descent, and moved to Sweden at the age of 25. Rebecca attended an English-speaking school in Sweden and was raised bilingual, speaking Swedish and English. As a student, she attended the Adolf Fredrik''s Music School in Stockholm and graduated in 1999.\nShe came into prominence with her breakout role of upper-class girl Anna Gripenhielm in the soap-opera Nya tider (1999), when she was 16 years old.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Rosamund Pike','1979-01-27','images/actors/rosamund_pike.jpg','Born on January 27, 1979 in London, England, actress Rosamund Mary Elizabeth Pike is the only child of a classical violinist mother, Caroline (Friend), and an opera singer father, Julian Pike. Due to her parents'' work, she spent her early childhood traveling around Europe. Pike attended Badminton School in Bristol, England and began acting at the National Youth Theatre. While appearing in a National Youth Theatre production of \"Romeo and Juliet\", she was first spotted and signed by an agent, although she continued her education at Wadham College, Oxford, where she read English Literature, eventually graduating with an upper second class honors degree.\nPike appeared in a number of UK television series, including Wives and Daughters (1999), before scoring an auspicious feature film debut as the glacial beauty \"Miranda Frost\" in the James Bond film, Die Another Day (2002); when the film was released, she was only 23. Though her debut was a big-budget action film, the film work that followed was primarily in smaller, independent films, including Promised Land (2004), The Libertine (2004), (for which she won the Best Supporting Actress award at The British Independent Film Awards), and Pride & Prejudice (2005), as one of the Bennet daughters. A brief foray into Hollywood film followed with the action flick, Doom (2005), and the thriller, Fracture (2007), but she returned to smaller films with exceptional performances in three films: An Education (2009), Made in Dagenham (2010), and the lead opposite Paul Giamatti in Barney''s Version (2010).');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Jamie Dornan','1982-05-01','images/actors/jamie_dornan.jpg','Jamie Dornan was born on May 1, 1982 in Belfast, Northern Ireland as James Dornan. He is an actor, known for Fifty Shades of Grey (2015), Anthropoid (2016) and Marie Antoinette (2006). He has been married to Amelia Warner since April 27, 2013. They have two children.');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Stanley Tucci','1960-11-11','images/actors/stanley_tucci.jpg','Actor Stanley Tucci was born on November 11, 1960, in Peekskill, New York. He is the son of Joan (Tropiano), a writer, and Stanley Tucci, an art teacher. His family is Italian-American, with origins in Calabria.\nTucci took an interest in acting while in high school, and went on to attend the State University of New York''s Conservatory of Theater Arts in Purchase. He began his professional career on the stage, making his Broadway debut in 1982, and then made his film debut in Prizzi''s Honor (1985).');".
"INSERT INTO actor(name,dob,profile_image,intro) VALUES('Faye Marsay','1986-12-30','images/actors/faye_marsay.jpg','Faye Marsay was born on December 30, 1986 in Middlesbrough, Cleveland, England. She is an actress, known for Pride (2014), Game of Thrones (2011) and Darkest Hour (2017).');";
    $db->exec($query);

    $query = "DROP TABLE IF EXISTS genre";
    $db->exec($query);
    $query = "CREATE TABLE genre (
  				id INTEGER PRIMARY KEY,
  				genre_name TEXT)";
    $db->exec($query);
    $query = "INSERT INTO genre(genre_name) VALUES('Sci-Fi');".
              "INSERT INTO genre(genre_name) VALUES('Comedy');".
              "INSERT INTO genre(genre_name) VALUES('Horror');".
              "INSERT INTO genre(genre_name) VALUES('Action');".
              "INSERT INTO genre(genre_name) VALUES('Crime');".
              "INSERT INTO genre(genre_name) VALUES('Drama');".
              "INSERT INTO genre(genre_name) VALUES('Biography');";
    $db->exec($query);

    $query = "DROP TABLE IF EXISTS review";
    $db->exec($query);
    $query = "CREATE TABLE review (
  				id INTEGER PRIMARY KEY,
  				movie_id INTEGER,
          user_name TEXT,
          user_email TEXT,
          date_ts TEXT,
          comment TEXT)";
    $db->exec($query);
    $query = "INSERT INTO review(movie_id,user_name,user_email,date_ts,comment) VALUES('1','Rahul Singh','test@mail.com',datetime('now'),'The moovie was quite impressive');".
              "INSERT INTO review(movie_id,user_name,user_email,date_ts,comment) VALUES('1','Amy Jackson','test2@mail.com',datetime('now'),'This is a test post. Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.');".
              "INSERT INTO review(movie_id,user_name,user_email,date_ts,comment) VALUES('2','Sameer Shrestha','test@mail.com',datetime('now'),'Was quite good, but could be even more better');".
              "INSERT INTO review(movie_id,user_name,user_email,date_ts,comment) VALUES('3','James Richards','test2@mail.com',datetime('now'),'The ending was not very good');".
              "INSERT INTO review(movie_id,user_name,user_email,date_ts,comment) VALUES('3','Karl Watson','test1@mail.com',datetime('now'),'This is a test post. Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.')";
    $db->exec($query);

    $query = "DROP TABLE IF EXISTS movie";
    $db->exec($query);
    $query = "CREATE TABLE movie (
  				id INTEGER PRIMARY KEY,
  				name INTEGER,
          director TEXT,
          genre TEXT,
          profile_image TEXT,
          release_date TEXT,
          intro TEXT,
          language TEXT,
          amount TEXT)";
    $db->exec($query);
    $query = "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Avengers: Infinity War (2018)','1','1','images/coverImages/avengers.jpg','2018-04-26','As the Avengers and their allies have continued to protect the world from threats too large for any one hero to handle, a new danger has emerged from the cosmic shadows: Thanos. A despot of intergalactic infamy, his goal is to collect all six Infinity Stones, artifacts of unimaginable power, and use them to inflict his twisted will on all of reality. Everything the Avengers have fought for has led up to this moment - the fate of Earth and existence itself has never been more uncertain.','Language','40');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Arrow: Season 6','2','1','images/coverImages/Arrow.jpg','2018-04-26','When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the changes the experience had on him, while secretly seeking reconciliation with his ex, Laurel. By day he picks up where he left off, playing the carefree philanderer he used to be, but at night he dons the alter ego of Arrow and works to right the wrongs of his family and restore the city to its former glory. Complicating his mission is Laurel''s father, Detective Quentin Lance, who is determined to put the vigilante behind bars.','Language','25');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Bay Watch','3','2','images/coverImages/BayWatch.jpg','2017-05-29','In sun-kissed Emerald Bay, the vigorous Lieutenant Mitch Buchannon and Baywatch, his elite team of hand-picked and perfectly tanned lifeguards, protect the bay, keeping both sunbathers and beach lovers safe. However, this summer, two new eager trainees will join the demanding life-saving program, as well as an insubordinate former Olympic swimmer, who are all called to prove their worth on the lifeguard towers just on time when a new synthetic street drug begins to infest the Emerald Bay: the flakka. Without a doubt, this calls for some serious undercover teamwork action, as the badgeless heroes in spandex comb the beach for shady newcomers and nefarious entrepreneurs with hidden agendas of their own. Can Mitch''s band save the bay?','Language','20');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Boar','4','3','images/coverImages/Boar.jpg','2018-06-14','In the harsh, yet beautiful Australian outback lives a beast, an animal of staggering size, with a ruthless, driving need for blood and destruction. It cares for none, defends its territory with brutal force, and kills with a raw, animalistic savagery unlike any have seen before.','Language','20');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Aquaman','5','4','images/coverImages/aquaman.jpg','2018-12-14','Arthur Curry learns that he is the heir to the underwater kingdom of Atlantis, and must step forward to lead his people and be a hero to the world.','English','40');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Johnny English Strikes Again','6','2','images/coverImages/johnnyEnglish.jpg','2018-10-05','JOHNNY ENGLISH STRIKES AGAIN is the third installment of the Johnny English comedy series, with Rowan Atkinson returning as the much loved accidental secret agent. The new adventure begins when a cyber-attack reveals the identity of all active undercover agents in Britain, leaving Johnny English as the Secret Service''s last hope. Called out of retirement, English dives head first into action with the mission to find the mastermind hacker. As a man with few skills and analog methods, Johnny English must overcome the challenges of modern technology to make this mission a success. ','English','25');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('The Old Man & the Gun','7','5','images/coverImages/oldMan.jpg','2018-12-07','Based on the true story of Forrest Tucker (Robert Redford), from his audacious escape from San Quentin at the age of 70 to an unprecedented string of heists that confounded authorities and enchanted the public. Wrapped up in the pursuit are detective John Hunt (Casey Affleck), who becomes captivated with Forrest''s commitment to his craft, and a woman (Sissy Spacek), who loves him in spite of his chosen profession. JOHNNY ENGLISH STRIKES AGAIN is the third installment of the Johnny English comedy series, with Rowan Atkinson returning as the much loved accidental secret agent. The new adventure begins when a cyber-attack reveals the identity of all active undercover agents in Britain, leaving Johnny English as the Secret.','English','35');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Creed II','8','6','images/coverImages/creedII.jpg','2018-11-30','Under the tutelage of Rocky Balboa, newly crowned light heavyweight champion Adonis Creed faces off against Viktor Drago, the son of Ivan Drago.','English','15');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Truth or Dare','9','3','images/coverImages/TruthorDare.jpg','2018-04-13','A harmless game of Truth or Dare among friends turns deadly when someone or something begins to punish those who tell a lie or refuse the dare.','English','20');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('Tomb Raider','10','4','images/coverImages/TombRaider.jpg','2018-03-14','Lara Croft is the fiercely independent daughter of an eccentric adventurer who vanished when she was scarcely a teen. Now a young woman of 21 without any real focus or purpose, Lara navigates the chaotic streets of trendy East London as a bike courier, barely making the rent, and takes college courses, rarely making it to class. Determined to forge her own path, she refuses to take the reins of her fathers global empire just as staunchly as she rejects the idea that hes truly gone. Advised to face the facts and move forward after seven years without him, even Lara cant understand what drives her to finally solve the puzzle of his mysterious death. Going explicitly against his final wishes, she leaves everything she knows behind in search of her dad. This is a test post. Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.','English','25');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('The Greatest Showman','11','7','images/coverImages/GreatestShowman.jpg','2017-12-26','Orphaned, penniless but ambitious and with a mind crammed with imagination and fresh ideas, the American Phineas Taylor Barnum will always be remembered as the man with the gift to effortlessly blur the line between reality and fiction. Thirsty for innovation and hungry for success, the son of a tailor will manage to open a wax museum but will soon shift focus to the unique and peculiar, introducing extraordinary, never-seen-before live acts on the circus stage. Some will call Barnum''s wide collection of oddities, a freak show; however, when the obsessed showman gambles everything on the opera singer Jenny Lind to appeal to a high-brow audience, he will somehow lose sight of the most important aspect of his life: his family. Will Barnum risk it all to be accepted? ','English','30');".
            "INSERT INTO movie(name,director,genre,profile_image,release_date,intro,language,amount) VALUES('A Private War','12','7','images/coverImages/APrivateWar.jpg','2018-11-02','In a world where journalism is under attack, Marie Colvin (Rosamund Pike) is one of the most celebrated war correspondents of our time. Colvin is an utterly fearless and rebellious spirit, driven to the frontlines of conflicts across the globe to give voice to the voiceless, while constantly testing the limits between bravery and bravado. After being hit by a grenade in Sri Lanka, she wears a distinctive eye patch and is still as comfortable sipping martinis with London''s elite as she is confronting dictators. Colvin sacrifices loving relationships, and over time, her personal life starts to unravel as the trauma she''s witnessed takes its toll. Yet, her mission to show the true cost of war leads her -- along with renowned war photographer Paul Conroy (Jamie Dornan) -- to embark on the most dangerous assignment of their lives in the besieged Syrian city of Homs. ','English','20');";

    $db->exec($query);

    $query = "DROP TABLE IF EXISTS admin_user";
    $db->exec($query);
    $query = "CREATE TABLE admin_user (
  				id INTEGER PRIMARY KEY,
  				user_login_id TEXT,
  				password TEXT,
          full_name TEXT)";
    $db->exec($query);
    $query = "INSERT INTO admin_user(user_login_id,password,full_name) VALUES('admin','admin','Administrator');";
    $db->exec($query);

    $query = "DROP TABLE IF EXISTS actor_enrolled";
    $db->exec($query);
    $query = "CREATE TABLE actor_enrolled (
  				id INTEGER PRIMARY KEY,
  				movie_id TEXT,
  				actor_id TEXT)";
    $db->exec($query);
    $query = "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('1','1');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('1','2');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('1','3');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('1','4');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('1','5');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('11','6');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('11','7');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('11','8');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('11','9');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('11','10');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('12','11');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('12','12');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('12','13');".
              "INSERT INTO actor_enrolled(movie_id,actor_id) VALUES('12','14');";
    $db->exec($query);
  }
  catch(Exception $e){
    throw $e;

  }

}


init($db);

 ?>
