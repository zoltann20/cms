-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 24. 19:42
-- Kiszolgáló verziója: 10.4.19-MariaDB
-- PHP verzió: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cms`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `attachments`
--

CREATE TABLE `attachments` (
  `ID` int(11) NOT NULL,
  `contentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dir` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `filename` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `automoderation`
--

CREATE TABLE `automoderation` (
  `ID` int(11) NOT NULL,
  `word` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `automoderation`
--

INSERT INTO `automoderation` (`ID`, `word`) VALUES
(1, 'xd'),
(2, 'csúnya'),
(3, 'ronda');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `status` set('1') COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`ID`, `name`, `status`) VALUES
(1, 'Politika', '1'),
(2, 'Sport', '1'),
(3, 'Állatvilág', '1'),
(4, 'Szórakozás', '1'),
(5, 'Kultúra', '1'),
(7, 'Technólógia', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `contentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`ID`, `contentID`, `userID`, `date`, `comment`) VALUES
(7, 3, 3, '2024-11-21 17:17:17', 'Nice '),
(9, 3, 3, '2024-11-21 17:17:17', 'xd'),
(14, 4, 6, '2025-02-22 11:47:43', 'szép');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contents`
--

CREATE TABLE `contents` (
  `ID` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `short` text COLLATE utf8_hungarian_ci NOT NULL,
  `content` text COLLATE utf8_hungarian_ci NOT NULL,
  `date` datetime NOT NULL,
  `postpicture` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `status` set('1') COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `contents`
--

INSERT INTO `contents` (`ID`, `catID`, `title`, `short`, `content`, `date`, `postpicture`, `userID`, `status`) VALUES
(3, 2, 'kijutott az EB-re a válogatottunk', 'A magyar labdarúgó-válogatott a Bulgária elleni döntetlennel – egy körrel a selejtezősorozat zárása előtt – bebiztosította a részvételét a 2024-es Európa-bajnokságon.', 'A Bulgária elleni sikerrel az Eb-részvételt már bebiztosította a magyar válogatott, a selejtezősorozat azonban még nem ért véget, vasárnap 15 órától Montenegrót fogadja a nemzeti csapatunk a Puskás Arénában. Így tétje már nem lesz a mérkőzésnek, de az biztos, hogy telt ház várja a csapatokat, és a nagyjából 60 ezer magyar szurkoló előtt nem lehet más a célja Szoboszlai Dominikéknak, minthogy győzelemmel és így veretlenül fejezzék be a selejtezőt.', '2024-11-21 17:17:17', 'hun.jpg', 3, '1'),
(4, 7, 'Iphone 12', 'Megjelent az iPhone 15 széria - Íme minden, amit bemutatott ma az Apple', '2023.09.13. – Az Apple két nagy eseményt rendez évente. Az egyik a fejlesztői WWDC, ahol inkább a szoftveres oldal újdonságait mutatja be az óriáscég. A másik pedig a szeptemberben, néha októberben megrendezett őszi Keynote, ahol az új iPhone készülékeké a főszerep, de ekkor debütálnak az új Apple Watch verziók is. Magyar idő szerint szeptember 12-én, 19:00 óra környékén kezdődött a Wonderlust fantáziacímet viselő esemény, ahol az Apple bemutatta a legújabb készülékeit. Az elkövetkezendő napokban, hetekben bizonyára több, részletesebb információt is megtudhatunk majd az újoncokkal kapcsolatban, ám a cég nem finomkodott az információk átadásában most sem.', '2024-11-21 17:17:17', 'iphone12.jpg', 3, '1'),
(11, 5, 'Curtis hajbeültetése', 'Széki Attila, vagy ahogyan mindenki ismeri, Curtis, az elmúlt években számos változáson ment keresztül, mind a magánéletében, mind a karrierjében.', 'A népszerű rapper és médiaszemélyiség nemcsak zenei sikereivel és televíziós szerepléseivel került a figyelem középpontjába, hanem életmódváltásával is.\r\n\r\nEnnek egyik látványos lépése volt a hajbeültetés, amelyet nyíltan vállalt, inspirálva ezzel rengeteg férfit, akik hasonló problémával küzdenek.\r\n\r\nDe mi vezetett Curtis döntéséhez, és milyen lett a végeredmény?\r\n\r\nCikkünkben ezekre a kérdéskre adunk választ!', '2025-02-22 12:02:35', 'curtis.jpg', 6, '1'),
(13, 4, 'Egy nagy adag szenvedély és cenzúra nélküli dalok ', 'Olyan népszerű magyar előadók lépnek fel augusztusban és szeptember elején a Gyárkert KultúrPark színpadán, mint Azahriah, Rúzsa Magdi, Demjén, Hiperkarma, Krúbi és Beton.Hofi, de még a német Kraftwerk és a skóciai Franz Ferdinand is koncertet ad. Mindemellett a Balaton Piknik is Veszprémbe költözik egy napra.', '<h3 style=\"box-sizing: border-box; border: 0px; font-size: 30px; margin: 0px; padding: 40px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; width: 759px; float: none; line-height: 38px; color: #323232; background-color: #ffffff;\">Telt h&aacute;z</h3>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">N&eacute;h&aacute;ny előad&oacute; koncertj&eacute;re m&aacute;r nem is lehet jegyet kapni, a rajong&oacute;k az &ouml;sszeset elkapkodt&aacute;k. A&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Kraftwerk</strong>&nbsp;n&eacute;met zenekar &ndash; amely vil&aacute;gszerte fők&eacute;pp az elektronikus zene &uacute;tt&ouml;rő jellegű n&eacute;pszerűs&iacute;t&eacute;s&eacute;ről &eacute;s művel&eacute;s&eacute;ről h&iacute;res &ndash;&nbsp;augusztus 9-&eacute;n, szerd&aacute;n este 9-kor l&eacute;p sz&iacute;npadra.</p>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">A magyar előad&oacute;k k&ouml;z&uuml;l&nbsp;<a id=\"hyperlink_798b25633b20c6b0dd06f6ed571cbf24\" style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; color: #d74000; text-decoration-line: none;\" title=\"Demj&eacute;n Ferenc sl&aacute;gereivel romantikus v&iacute;gj&aacute;t&eacute;k k&eacute;sz&uuml;l\" href=\"https://dex.hu/x.php?id=index_kultur_cikklink&amp;url=https%3A%2F%2Findex.hu%2Fkultur%2F2023%2F07%2F04%2Fdemjen-ferenc-slager-romantikus-vigjatek-film-dal%2F\" target=\"_blank\" rel=\"noopener\">Demj&eacute;n Ferenc</a>, a Hiperkarma, R&uacute;zsa Magdi &eacute;s Azahriah bizonyultak a legn&eacute;pszerűbbnek.&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Demj&eacute;n</strong>&nbsp;augusztus 12-&eacute;n, szombat este 8-kor, a&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Hiperkarma</strong>&nbsp;pedig augusztus 16-&aacute;n, d&eacute;lut&aacute;n 5-kor&nbsp;ad telt h&aacute;zas koncertet, amelyekre egy&eacute;bk&eacute;nt ingyenesen lehetett regisztr&aacute;lni.</p>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">Augusztus 20-&aacute;n 17 &oacute;rakor&nbsp;a hazai zenei szc&eacute;na egyik legn&eacute;pszerűbb előad&oacute;ja,&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">R&uacute;zsa Magdi</strong>&nbsp;var&aacute;zsolja el a k&ouml;z&ouml;ns&eacute;get.&nbsp;A t&ouml;bbsz&ouml;r&ouml;s platinalemezes &eacute;nekesnő nagysz&iacute;npados show-j&aacute;n a j&oacute;l ismert sl&aacute;gerek mellett felcsend&uuml;lnek az &uacute;j szerzem&eacute;nyei is.&nbsp;A&nbsp;koncertet &ndash; ami m&aacute;r szint&eacute;n telt h&aacute;zas &ndash; Veszpr&eacute;m v&aacute;ros Szent Istv&aacute;n-napi &uuml;nnepi programjai keret&eacute;ben szervezik.&nbsp;</p>\r\n<div id=\"microsite_microsite\" class=\"miniapp microsite\" style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 16px 0px 0px; padding: 0px 16px; vertical-align: baseline; -webkit-font-smoothing: antialiased; width: 759px; float: none; clear: left; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\"></div>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">Szeptember 1-j&eacute;n d&eacute;lut&aacute;n 5-kor&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Azahriah</strong>&nbsp;l&eacute;p sz&iacute;npadra, aki&nbsp;fiatal kora ellen&eacute;re &oacute;ri&aacute;si rajong&oacute;t&aacute;borral rendelkezik. Id&eacute;n m&aacute;rciusban a Papp L&aacute;szl&oacute; Sportar&eacute;n&aacute;t is&nbsp;<a id=\"hyperlink_8cb9883e9ddb3fbf6623ea4da05c1540\" style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; color: #d74000; text-decoration-line: none;\" title=\"Erős Ant&oacute;nia &eacute;s Szellő Istv&aacute;n sokkolta a n&eacute;zőket Azahriah ar&eacute;n&aacute;s koncertj&eacute;n\" href=\"https://dex.hu/x.php?id=index_kultur_cikklink&amp;url=https%3A%2F%2Findex.hu%2Fkultur%2F2023%2F03%2F11%2Feros-antonia-es-szello-istvan-sokkolta-a-nezoket-azahriah-arenas-koncertjen-desh-papp-laszlo-zene-memento-kukasauto-rap%2F\" target=\"_blank\" rel=\"noopener\">megt&ouml;lt&ouml;tte</a>&nbsp;&ndash; amit a 21 &eacute;ves &eacute;nekes-rapper &eacute;lete eddigi cs&uacute;csteljes&iacute;tm&eacute;nyek&eacute;nt k&ouml;nyvelhet el &ndash;, &iacute;gy nem meglepő, hogy a gy&aacute;rkertes fell&eacute;p&eacute;s&eacute;re m&aacute;r most elkelt az &ouml;sszes jegy. Mint azt t&ouml;bbsz&ouml;r hangs&uacute;lyozta,&nbsp;zen&eacute;i nem csak saj&aacute;t gener&aacute;ci&oacute;j&aacute;nak sz&oacute;lnak. Van olyan sz&aacute;ma, amely egy h&eacute;t alatt 1,2 milli&oacute;s n&eacute;zetts&eacute;get &eacute;rt el a YouTube-on.&nbsp;</p>\r\n<h3 style=\"box-sizing: border-box; border: 0px; font-size: 30px; margin: 0px; padding: 40px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; width: 759px; float: none; line-height: 38px; color: #323232; background-color: #ffffff;\">Cenz&uacute;ra n&eacute;lk&uuml;li dalok</h3>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">A&nbsp;sz&oacute;kimond&oacute;, kompromisszum &eacute;s cenz&uacute;ra n&eacute;lk&uuml;li dalair&oacute;l h&iacute;res&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Kr&uacute;bi</strong>&nbsp;&ndash; aki&nbsp;Magyarorsz&aacute;g egyik legkeresettebb előad&oacute;ja &ndash; szint&eacute;n fell&eacute;p a Gy&aacute;rkertben augusztus 11-&eacute;n.&nbsp;Az ismert &eacute;s elk&eacute;pesztően n&eacute;pszerű rapper 2017-ben robbant be a k&ouml;ztudatba, zen&eacute;je alapvetően humoros, provokat&iacute;v, de gyakran komoly k&eacute;rd&eacute;seket feszeget.</p>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">A rock, a jazz, a blues, a soul &eacute;s a funky vil&aacute;g&aacute;ban is otthonosan mozg&oacute;&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Charlie</strong>&nbsp;augusztus 17-&eacute;n, a hossz&uacute; &eacute;vtizedek &oacute;ta sz&aacute;rnyal&oacute;, t&ouml;bb zenei projectet meg&aacute;lmod&oacute;&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Geszti P&eacute;ter</strong>&nbsp;pedig augusztus 18-&aacute;n ad koncertet. Az 1999-ben alakult&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Fish!</strong>&nbsp;magyar &bdquo;hardpop&rdquo; egy&uuml;ttes fell&eacute;p&eacute;s&eacute;re &ndash; amely augusztus 23-&aacute;n lesz &ndash; ingyenesen lehet m&eacute;g regisztr&aacute;lni.&nbsp;</p>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\"><strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Franz Ferdinand</strong>&nbsp;augusztus 29-&eacute;n &eacute;rkezik haz&aacute;nkba.&nbsp;A t&ouml;bb mint 20 &eacute;ve alakult glasgow-i indie rock egy&uuml;ttes az elm&uacute;lt hetekben Eur&oacute;p&aacute;ban turn&eacute;zott, augusztus v&eacute;g&eacute;n pedig Veszpr&eacute;mben ad koncertet, hogy a v&aacute;ros leg&uacute;jabb rendezv&eacute;nyhelysz&iacute;n&eacute;n egy igaz&aacute;n őr&uuml;letes bulival z&aacute;rja a nyarat. Nagysz&iacute;npados koncertj&eacute;re a f&uuml;lbem&aacute;sz&oacute; &eacute;s izgalmas sz&aacute;mair&oacute;l is ismert zenekar olyan sl&aacute;gerekkel k&eacute;sz&uuml;l, mint a&nbsp;<em style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Take Me Out,</em>&nbsp;a&nbsp;<em style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Do You Want To,</em>&nbsp;a&nbsp;<em style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">The Walk Away,</em>&nbsp;a&nbsp;<em style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Ulysses</em>&nbsp;&eacute;s az&nbsp;<em style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Outsiders.</em></p>\r\n<h3 style=\"box-sizing: border-box; border: 0px; font-size: 30px; margin: 0px; padding: 40px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; width: 759px; float: none; line-height: 38px; color: #323232; background-color: #ffffff;\">Egy nagy adag szenved&eacute;ly</h3>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">Augusztus 30-&aacute;n a&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Carson Coma</strong>&nbsp;l&eacute;p fel a veszpr&eacute;mi Gy&aacute;rkert sz&iacute;npad&aacute;n.&nbsp;Magyarorsz&aacute;g egyik legfelkapottabb fiatal rockzenekara&nbsp;egyre ny&iacute;ltabban &eacute;s vil&aacute;gosabban &eacute;rinti azokat a h&eacute;tk&ouml;znapi probl&eacute;m&aacute;kat, amelyeket mindannyian &aacute;t&eacute;l&uuml;nk, rajong&oacute;t&aacute;boruk folyamatosan nő, fell&eacute;p&eacute;seik rendre telt h&aacute;zasak. A hattag&uacute; form&aacute;ci&oacute; ny&aacute;r v&eacute;gi bulija &eacute;pp ez&eacute;rt kihagyhatatlan program.</p>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">Augusztus 31-&eacute;n&nbsp;a hazai k&ouml;nnyűzenei &eacute;let meghat&aacute;roz&oacute; alakja,&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Majka</strong>&nbsp;ad koncertet.&nbsp;Ahogy ő fogalmaz: fontos, hogy aki elj&ouml;n a bulijaikra, az j&oacute;l &eacute;rezze mag&aacute;t az első perctől az utols&oacute;ig. Nem lesz ez m&aacute;sk&eacute;pp a Gy&aacute;rkertben sem, ahol egy&uuml;tt &uuml;v&ouml;ltj&uuml;k majd:&nbsp;<em style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Mindenki t&aacute;ncol!</em></p>\r\n<p style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 0px; padding: 24px 16px 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; line-height: 24px; width: 759px; float: none; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">V&eacute;g&uuml;l, de nem utols&oacute;sorban&nbsp;<strong style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">Beton.Hofi</strong>, azaz Schwarcz &Aacute;d&aacute;m l&eacute;p a Gy&aacute;rkert sz&iacute;npad&aacute;ra szeptember 2-&aacute;n, aki r&ouml;vid idő alatt robbant be a k&ouml;ztudatba. Dalsz&ouml;vegei, mondanival&oacute;ja &eacute;s előad&aacute;sm&oacute;dja miatt m&aacute;ra ő a hazai k&ouml;nnyűzene egyik legizgalmasabb szereplője. Mint kor&aacute;bban fogalmazott: &bdquo;A focival eltűnt az &eacute;letemből egy nagy adag szenved&eacute;ly. Kellett valami a hely&eacute;re. Ez lett a rap.&rdquo;</p>\r\n<div id=\"microsite_microsite\" class=\"miniapp microsite\" style=\"box-sizing: border-box; border: 0px; font-size: 16px; margin: 16px 0px 0px; padding: 0px 16px; vertical-align: baseline; -webkit-font-smoothing: antialiased; width: 759px; float: none; clear: left; color: #323232; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; background-color: #ffffff;\">\r\n<div id=\"ado-AHFWMrxYQoI5SsTFGhzJczHUjwb.7A_up1HUiuzirKD.G7\" class=\"iap iap--ado \" style=\"box-sizing: inherit; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; -webkit-font-smoothing: antialiased; position: relative; flex-direction: column; align-items: center; width: 727px; background-color: #f1f1f1; text-align: center; opacity: 0; display: flex !important;\" data-id=\"ado-AHFWMrxYQoI5SsTFGhzJczHUjwb.7A_up1HUiuzirKD.G7\"></div>\r\n</div>', '2025-02-24 19:29:28', 'veszprem.jpg', 6, '1'),
(14, 3, 'Kutyák világnapja: mit köszönhetünk kiskedvencünkn', 'Augusztus 26-án, vagyis ma van a kutyák világnapja. Négylábú kedvenceink tudattalanul, de rendkívül sokat tesznek értünk. Nem véletlen, hogy ők az ember legjobb barátai. Cikkünkben a kutyatartás egészségre gyakorolt pozitív hatásait igyekszünk összegyűjteni.', '<p>A kuty&aacute;k vil&aacute;gnapj&aacute;t vil&aacute;gszerte k&uuml;l&ouml;nf&eacute;le esem&eacute;nyekkel &eacute;s tev&eacute;kenys&eacute;gekkel &uuml;nneplik. Ezek az esem&eacute;nyek nemcsak a kuty&aacute;k tisztelet&eacute;re szolg&aacute;lnak, hanem a kuty&aacute;kkal kapcsolatos t&aacute;rsadalmi k&eacute;rd&eacute;sekre is felh&iacute;vj&aacute;k a figyelmet, mint p&eacute;ld&aacute;ul az &aacute;llatmenhelyek t&aacute;mogat&aacute;sa, a kuty&aacute;k &ouml;r&ouml;kbefogad&aacute;s&aacute;nak n&eacute;pszerűs&iacute;t&eacute;se, vagy a felelős kutyatart&aacute;s fontoss&aacute;ga&nbsp;<a href=\"https://unnepinfo.hu/a-kutyak-vilagnapja-augusztus-26/\" target=\"_blank\" rel=\"noopener noreferrer\">&ndash; &iacute;rj az &Uuml;nnepinf&oacute;.</a></p>\r\n<p>Ezen a napon eml&eacute;kez&uuml;nk meg az ember legr&eacute;gebbi &eacute;s leghűs&eacute;gesebb h&aacute;zi&aacute;llat&aacute;r&oacute;l. A&nbsp;<a href=\"https://magazin.petissimo.hu/cikk/a-kutyak-jotekony-hatasa\" target=\"_blank\" rel=\"noopener noreferrer\">Petissimo</a>&nbsp;&eacute;s&nbsp;<a href=\"https://www.azenkutyam.hu/elet/kutya-hatasa-az-emberre/\" target=\"_blank\" rel=\"noopener noreferrer\">Az &eacute;n kuty&aacute;m</a>&nbsp;nevű internetes port&aacute;lok seg&iacute;ts&eacute;g&eacute;vel az al&aacute;bbi j&oacute;t&eacute;kony hat&aacute;sokat gyűjt&ouml;tt&uuml;k &ouml;ssze, amelyet kedvenceink ment&aacute;lis vagy fizikai eg&eacute;szs&eacute;g&uuml;nkre gyakorolnak:</p>\r\n<h1>1. A kuty&aacute;k cs&ouml;kkentik a mag&aacute;nyoss&aacute;gunkat</h1>\r\n<p>A kuty&aacute;k akkor is melletted lesznek, ha az emberek nem. A felt&eacute;tel n&eacute;lk&uuml;li szeretetet, &eacute;rzelmi t&aacute;mogat&aacute;st ad, amely seg&iacute;ts&eacute;g&eacute;vel sikeresen elker&uuml;lhető a t&aacute;rsadalmi elszigetelts&eacute;get. A mag&aacute;ny &eacute;rz&eacute;s&eacute;nek cs&ouml;kkent&eacute;se k&uuml;l&ouml;n&ouml;sen j&oacute;l kimutathat&oacute; volt a pand&eacute;mia idej&eacute;n, amikor nem felt&eacute;tlen tal&aacute;lkozhattunk bar&aacute;tainkkal vagy csal&aacute;dtagjainkkal.</p>\r\n<h1>2. J&oacute; hat&aacute;s a sz&iacute;vre</h1>\r\n<p>Az 1950 &eacute;s 2019 k&ouml;z&ouml;tt k&ouml;zz&eacute;tett tanulm&aacute;nyok &aacute;tfog&oacute; &aacute;ttekint&eacute;se meg&aacute;llap&iacute;totta, hogy a kutyatulajdonosok eset&eacute;ben alacsonyabb a korai sz&iacute;vroham kock&aacute;zata. A kutat&aacute;sok arra az eredm&eacute;nyre jutottak, hogy a gazdik v&eacute;rnyom&aacute;sa alacsonyabb, &eacute;s jobban reag&aacute;lnak a stresszre.</p>\r\n<h1>3. Seg&iacute;tik, hogy form&aacute;ban maradjunk</h1>\r\n<p>A mindennapi kutyas&eacute;t&aacute;ltat&aacute;s jelentősen megn&ouml;velik a gazdik napi mozg&aacute;smennyis&eacute;g&eacute;t.</p>\r\n<h1>4. Jav&iacute;tj&aacute;k a szoci&aacute;lis k&eacute;szs&eacute;geinket</h1>\r\n<p>Egyes kutat&aacute;sok szerint a kuty&aacute;sok k&ouml;nnyebben teremtenek kapcsolatot ember t&aacute;rsaikkal &eacute;s k&ouml;nnyebben szereznek bar&aacute;tokat.</p>', '2025-02-24 19:33:53', 'dog.jpg', 6, '1'),
(15, 1, 'Lehet-e politikai mémekkel bármilyen változást elé', 'Hatással lehet a politikai közbeszédre a legnépszerűbb mémgyártó valamelyik jól eltalált képe? Képesek-e befolyásolni a választói akaratot a többezer like-ot bezsebelő, esetenként 3 millió emberhez is eljutó posztok?', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 32px; line-height: 1.68; color: #111115; font-family: \'Work Sans\', sans-serif; font-size: 18px; background-color: #ffffff;\">Az Amerikai Egyes&uuml;lt &Aacute;llamokban rengeteg &uacute;j szavaz&oacute;t tudott megsz&oacute;l&iacute;tani a demokrata eln&ouml;kjel&ouml;lt,&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">Kamala Harris&nbsp;</span>azzal, hogy t&ouml;k&eacute;letesen siker&uuml;lt&nbsp;<a style=\"box-sizing: border-box; text-decoration-line: none; transition: color 0.5s;\" href=\"https://24.hu/kultura/2024/08/03/mem-amerikai-elnokvalasztas-tiktok-kamala-harris-donald-trump-charli-xcx/\" target=\"_blank\" rel=\"noopener\">haszn&aacute;lnia &eacute;s hasznos&iacute;tania</a>&nbsp;a ny&aacute;r uralkod&oacute; m&eacute;mj&eacute;t. Azt nem tudni, hogy az aleln&ouml;k nyerni fog-e novemberben, &eacute;s, ha igen, ez mennyiben k&ouml;sz&ouml;nhető az internetes folkl&oacute;rban elfoglalt, egy&eacute;bk&eacute;nt előkelő hely&eacute;nek, de besz&eacute;des lehet, hogy mostani ellenfele,&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">Donald Trump</span>&nbsp;a 2016-os v&aacute;laszt&aacute;sok előtt&nbsp;<a style=\"box-sizing: border-box; text-decoration-line: none; transition: color 0.5s;\" href=\"https://theconversation.com/how-donald-trump-won-the-2016-meme-wars-68580\" target=\"_blank\" rel=\"noopener\">megnyerte</a>&nbsp;a m&eacute;mh&aacute;bor&uacute;t&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">Hillary Clintonnal</span>&nbsp;szemben, &eacute;s k&eacute;sőbb a v&aacute;laszt&aacute;sokon is legyőzte ellenfel&eacute;t.</p>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 32px; line-height: 1.68; color: #111115; font-family: \'Work Sans\', sans-serif; font-size: 18px; background-color: #ffffff;\">Magyarorsz&aacute;gon ak&aacute;r 3-4 milli&oacute; emberhez is eljuthat egy-egy politikai m&eacute;m, de egyelőre nem l&aacute;tni, hogy egy k&eacute;p vagy vide&oacute; k&eacute;pes lehet-e arra, hogy &eacute;rdemben befoly&aacute;solja a k&ouml;zhangulatot, esetleg hat&aacute;ssal legyen a 2026-os v&aacute;laszt&aacute;sokra. &Iacute;gy v&eacute;li a k&eacute;t n&eacute;pszerű tartalomgy&aacute;rt&oacute;,&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">G&eacute;zamalac</span>&nbsp;&eacute;s&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">Andr&aacute;s</span>&nbsp;is, mik&ouml;zben&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">Bene M&aacute;rton</span>&nbsp;politol&oacute;gus, a TK Politikatudom&aacute;nyi Int&eacute;zet tudom&aacute;nyos főmunkat&aacute;rsa szerint elm&eacute;letileg m&eacute;g Magyarorsz&aacute;gon is elő&aacute;llhat olyan helyzet, amikor egy v&aacute;laszt&oacute;polg&aacute;r d&ouml;nt&eacute;seire hat&aacute;ssal lehet egy m&eacute;m.</p>', '2025-02-24 19:36:39', 'polotika.jpg', 6, '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `icon` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `param` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `parentID` int(11) NOT NULL,
  `queue` int(11) NOT NULL,
  `rights` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`ID`, `name`, `icon`, `param`, `parentID`, `queue`, `rights`) VALUES
(1, 'Tartalmak', 'card-text', 'contents_list', 0, 10, 2),
(2, 'Kategóriák kezelése', 'tag-fill', 'categories_list', 0, 20, 2),
(3, 'Felhasználók kezelése', 'people-fill', 'users_list', 0, 30, 1),
(4, 'Profil módosítás', 'gear-wide', 'users_profilmod', 0, 40, 2),
(5, 'Statisztika', 'bar-chart-fill', 'contents_stats', 0, 50, 2),
(6, 'Moderációk', 'slash-circle-fill', 'automoderation_list', 0, 60, 1),
(7, 'Naptár', 'calendar-check', 'contents_calendar', 0, 70, 2),
(8, 'Jelszó módosítás', 'key-fill', 'users_passmod', 0, 35, 2),
(9, 'Kezdőlap', 'house-fill', 'home', 0, 5, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rights`
--

CREATE TABLE `rights` (
  `ID` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rights`
--

INSERT INTO `rights` (`ID`, `name`) VALUES
(1, 'Adminisztrátor'),
(2, 'Felhasználó');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `reg` datetime NOT NULL,
  `last` datetime DEFAULT NULL,
  `rights` int(11) NOT NULL,
  `status` set('1') COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`, `reg`, `last`, `rights`, `status`) VALUES
(2, 'adminisztrator', 'admin@admin.com', '4aeb195cd69ed93520b9b4129636264e0cdc0153', '2024-11-21 17:17:17', '2024-11-21 17:17:17', 1, '1'),
(3, 'asd', 'asd@asd.asd', 'f10e2821bbbea527ea02200352313bc059445190', '2024-11-21 17:17:17', '2024-11-21 17:17:17', 1, '1'),
(5, 'Szenilis', 'sz@sz.sz', 'c57c8e6d6a0517959598de2c08de5cf8daa440ce', '2024-11-21 17:17:17', '2024-11-21 17:17:17', 2, '1'),
(6, 'Teszt Elek', 'teszt@teszt.teszt', '34228a532093278fcdc65c3a1338482e8bdc44f6', '2025-02-20 18:03:24', '2025-02-24 19:04:42', 1, '1');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `contentID` (`contentID`),
  ADD KEY `userID` (`userID`);

--
-- A tábla indexei `automoderation`
--
ALTER TABLE `automoderation`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `contentID` (`contentID`),
  ADD KEY `userID` (`userID`);

--
-- A tábla indexei `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `catID` (`catID`);

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `rights` (`rights`);

--
-- A tábla indexei `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `rights` (`rights`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `attachments`
--
ALTER TABLE `attachments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `automoderation`
--
ALTER TABLE `automoderation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `contents`
--
ALTER TABLE `contents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `rights`
--
ALTER TABLE `rights`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`contentID`) REFERENCES `contents` (`ID`),
  ADD CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`contentID`) REFERENCES `contents` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Megkötések a táblához `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `contents_ibfk_2` FOREIGN KEY (`catID`) REFERENCES `categories` (`ID`);

--
-- Megkötések a táblához `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`rights`) REFERENCES `rights` (`ID`);

--
-- Megkötések a táblához `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rights`) REFERENCES `rights` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
