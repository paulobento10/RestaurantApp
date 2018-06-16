-- MySQL dump 10.13  Distrib 5.6.33, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: RESTAURANTE
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dono`
--

DROP TABLE IF EXISTS `dono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `N_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `telemovel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `N_id` (`N_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dono`
--

LOCK TABLES `dono` WRITE;
/*!40000 ALTER TABLE `dono` DISABLE KEYS */;
INSERT INTO `dono` VALUES (2,'Pedro Costa',11111,'$2y$10$NEcavw6zyvW4fh9vGt1wtO/75FoJROR9PWOoB8p3hwo0VIyhbBnb2','mcekelkme',9999999);
/*!40000 ALTER TABLE `dono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ementa`
--

DROP TABLE IF EXISTS `ementa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ementa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` text NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `preco` float NOT NULL,
  `extras` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ementa`
--

LOCK TABLES `ementa` WRITE;
/*!40000 ALTER TABLE `ementa` DISABLE KEYS */;
/*!40000 ALTER TABLE `ementa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `segunda` text NOT NULL,
  `terca` text NOT NULL,
  `quarta` text NOT NULL,
  `quinta` text NOT NULL,
  `sexta` text NOT NULL,
  `sabado` text NOT NULL,
  `domingo` text NOT NULL,
  `feriados` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (1,'12:00 00:00','12:00 00:00','12:00 00:00','12:00 00:00','12:00 00:00','12:00 00:00','12:00 00:00','fechado');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_utilizador` text NOT NULL,
  `email_utilizador` text NOT NULL,
  `telemovel_utilizador` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(64) NOT NULL,
  `qtd_pessoas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurante`
--

DROP TABLE IF EXISTS `restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rota_id` int(11) DEFAULT NULL,
  `nome` text NOT NULL,
  `morada` text NOT NULL,
  `localidade` varchar(255) NOT NULL,
  `latitude` text,
  `longitude` text,
  `rating` int(11) DEFAULT NULL,
  `img1` blob NOT NULL,
  `takeaway` int(11) NOT NULL,
  `aberto` int(11) DEFAULT NULL,
  `tipo` text NOT NULL,
  `tipocomida` text NOT NULL,
  `ponto_interesse` int(11) DEFAULT NULL,
  `tags` text,
  `pequeno_almoco` int(11) NOT NULL,
  `brunch` int(11) NOT NULL,
  `link_pagina` text,
  `telemovel` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `count_rating` int(11) DEFAULT NULL,
  `preco_medio` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `capacidade` int(11) NOT NULL,
  `dinheiro` tinyint(1) NOT NULL,
  `cheque` tinyint(1) NOT NULL,
  `multibanco` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurante`
--

LOCK TABLES `restaurante` WRITE;
/*!40000 ALTER TABLE `restaurante` DISABLE KEYS */;
INSERT INTO `restaurante` VALUES (2,1,'o italiano','rua cedofeita 330','porto',NULL,NULL,NULL,'ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0		\n\r\Z\Z $.\' \",#(7),01444\'9=82<.342ÿÛ\0C			\r\r2!!22222222222222222222222222222222222222222222222222ÿÀ\0œ&\"\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0\0}\0!1AQa\"q2‘¡#B±ÁRÑð$3br‚	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyzƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚáâãäåæçèéêñòóôõö÷øùúÿÄ\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0w\0!1AQaq\"2B‘¡±Á	#3RðbrÑ\n$4á%ñ\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz‚ƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚâãäåæçèéêòóôõö÷øùúÿÚ\0\0\0?\0ðAÒFh\0¨Û0Ç¿âÏZø†öÎîÛNŽÉã´Ž–<w\\‚À™ü«ž¢§‘6¥ÕúXvtëHWiÁ4ªpÙ®Å:Ö—¬Å¤?Ns[Y$[T,ŠOÌ1×#ž*i¥`9®ôS±ž” àŒz¡	VP»}>;¸ÚG!•a-ò«8õÀ^@lm^úúD#|Ò,jXñ’p*×ˆ4i4\rzóJ–X¦–ÖMŒð¶TŸcY Á ƒÁô ±bKIäŸZ›;ß ú\r¢·4í/O»ðæ¯q~]Ùù_g¶8ÌûŸ\r æ±JúsB’wò	ÅhÜëw×š=Ž—q6û[‘­ÔŽSÌ*XgÓ+ŸÄÖw¾(ÆE;&#JßE»¼ÑouhU\rµ›Æ³ã+¼§q‘ŠÎÆ:ÓÒicŠH’WXå\0:† 0##¿ Uí\Z-2âíâÕn¤¶„Âæ9Q7b@¤ #®	Àüi]«¶=Ìÿ\0Æc4¥3Èä\nmPƒÖ’—§\"€”fŠZ\01EæŽ”\0½EæÓ­ Š=è)=éqùQŠ\0LQJ(Å`ëÒŒS’&‘°‹“OŽiv6W×ŠAfAÞz½ýœí Ù’‡¹«é¡Ëyî sŽ…TœÑÌŠPlÂÛÆqøÔÑ[<À•Àú÷®ÊÇÁZ„é´Âãyþ‚·¬þùQ©¸Ÿ`ŒÎ§¨½ÙæVö¬Î|Å8S‚*êéRIq—zªŒ×©ÁáÍË¶ÈÀ÷ËsWÑ­bmíx¼Ê‹É–vyÄ>Ô.á!­ÙAè$ã§màiþV¸•¨Ïêkµk‹ŒavF=…W‘\ZN^W>Ù©wîRqìbÁá}.×æ™ƒ°ìÍŸÐUäŠÆ-r}—dEt@iùÀö©²ê7>Únœò±*{·ZUŽb~yÛ‹Ræ“ÐŠ.EØåDQÐ·¹5 |qŠ‹4£Ò†‹Se…sI$™\\Lâ‚	CÅEyÛDÜÇo’g\nƒ¹ªPê^6 ˆ*vy[h5^cÒµÄ °WÛvÇ©úÖ=Õ”“ÝeÄWk\rÇ8ÿ\0=«Ec7mNHîrÁ”ÉlgrŸzÕ·euÞ§ Ž\ra[Iö.0®Q¿v sŽ?–hèNZÒPs„ô¡­4]ÝËî»…@@ÏZ´HÇ½VqëéRIö!<ž*‰RÝÈqŠ¹vÉ§ÚeáÏ{×/3Éu.ùŽÃ°ªM(=‡\\ÝËuòŒ¬~ê¯–3š±…˜¦S‘ÉÏ ¤ÛcI%¡ÁŽJM¸è*¥Î¯oo!k³ŽFMu˜â8@îi¨°æ6|¾95(f§·Î‰dÝÃ4ö³Y\"d?Ä0iÕ“\\Û ÃJ£ñ¢ß^³«ÆÌû\nÂ¹„ÛÜ<Mü&˜0]´n÷=SMñµä¥Ê>3Š+Ó.A„ÆN(®gCSÐŽ)ÛSš*GHk®ñæ±¡kšÅ¬¾±¶ñZÇŸ&Íò§ˆïŒ×9L×T&å&¬y\\ºÙ¬jcäúÓ\'5ª¶ˆ9õ¤û\Zã†\"Žrý›2ŒL9Å!Fkýˆ¶6°Å0ÙËž9ÞŸ0{6e©ÚÙ¶¼O¯Câûk¸´ø¬Ù-c†UŒ²:è1‘Ž=ªi&~æqøÓ>Æ\n’x>„RÑ»‹’I¢·’æTŠi$c…E$ú\n‘£b¬aÁµhØÜÞhš•½ýœ†+›y‘>Á\"¡Õ5µmVïP¸HÖk©ži5Â†bIÀì2j•ïäEŠt}+NßB¿¼Ño5{xì¬Ùâ@GîËœ.}‰ãò¬ÌcÚšiì «šSÚG«Zµú³Z	WÎÔ¦Fì~ªtPÕÕ€ÐÖÂ]nõô´xìîmÕúˆòvçßªO*†*@=­7?Î¶µO¶¥¡húY´‚!¦¤«æ¨ùæÞÛ¾o§\0~>´µVHz3ŠÒ¶ÑnïtkíVÁµ±1‰Ø°w«ÇSÍgŽ´ÓL,hh\ZœZ6·k5”WÐÄù’Ú_»\"žö8<Æ£°°›WÔà±´uÍÄ‚8“ nbp5JŸ²A2K²JŒ]N\n‘ÐƒëI®¨.,ðIm3Ã*”‘«)êàŠŽ¯ØÍm6¯š³Îö²L\ZéÐæB¤üÄg«c?$Ö‰.§5¾œÏušË	wH œ½y¨¿p·b–(Ç4¸9Á¢˜„ÆÒŒÒÑŽø bv¥4–³Æ‰#Äê’}Æ#†úTÇO”ªíù˜õ\\Š\\È\ntª+Sû\"Fo.4c\"ýìr3øV¥¿…onW‹f@1‚ãn:ŸiÔns^S…Ý´R%«¼{‡~ÕÛÛø:v¸•tÚ¼â´mü3§Zÿ\0­s)÷=?Sí/±~Ï¹ÀÛéâXÈ ï# \n»a ÝÍ¼%´’Ñ¶ñù×¡ÛÚY[ô{A“Ü\'õ­(æ(ÄH˜õæšmî)$¶8[/ß;¢Æäó“ô­è<n­¾ê|Œr …Ïó­ö–C÷¥lz)£dúšNÝÁ9v#ƒEÑm\0Ä#EÏó«¿i†0EÇ«tªåÖ£i©flÔ“Jë¢-9ue‰.î¤Y1þÈªälÉ#9÷5WûFÓv>Ó~µdy ô¢íìÅùGEàN=)¸æšM°Ø	ç‡Þ”ô¤%\"]Ò  XÙ»`PÏmµ¤ªWîùTá}jƒsÉ$±îj\\#Mõ6·ÀÃAùÒ„ù[5ˆ{T‰,±œ†4”»ÓìÍ|`àÓÂ÷ªê*þ5­K4BHNáÖ©É©È‰G­KŒ©QÔŽ(Î1S$D6î:ReDæì-ÑËZÏ/’þf# ¦]Üè+,°Ã-ÂÉ 0“éÀÅt—:E½énhgÆ<Äç?QT…|¹¾Õ\n…ä­ðÃ?¦hç]Y·²•½Ôû”¿µd¸Ò­­¢†>Ô¢§ÎOLŸÎ´¬,E…’@H2ur=jýž“obÄŒd#YXoAD©Î3Jéì‹KÞwe7ëÖ­ÚÛ¬Q5Ô¼*ò	þtë¶\\9Ú9cíTüGq“öHŽ!ï`ðO¥EJ–÷QXz7÷å±ÅxŸ^î·E\Z˜”•RÕÌI«^HÖmíòŠÒÔVY)LFò»ƒíÓúV	â¶§kb/Ïs ðüpÓ	]†9­á\nƒÒ¹MàCª\"“…l?Ò»]¿—µ[0LâüEl ½Y\0Àg§zÆïžõÛø†Áîtíè…ž#žnõÄ“ÍR:Ï\\yöf&<ÆqøVÈNßÖ¸íá¡ÕbŒt•‚Æ½ì«ÜçéRÖ¥)%£8ÏYìt¸P>o•`nè:õ¨“G¸Úƒr®A=«€Ku¿&žÈ½°Á##e	ô¢¯AœñEKšGDp³jå(-÷àc¹«ë\ZF0¿­4\08‘CfV:µ.OA¥.œ¿ÚKvÒ½Þ\0;6à(=O?ÈzñÏŒýiJaÏZæ¢1QZ¹<JB ã¦i+jÛÄgð…Ö†,âo´Î“†\0²…ì8ýsÓ#½aàƒÁ¤›w¹Dƒ®j¼§’zšÒ\Zuçögö‘¶“ìbO(ÎäŒã>µ™!ùÖœ]Å-ˆˆ¸pô5Zk@Ã÷}}*ÙÁ¤Ç~õªfM\\¥\råõ•µÕ¤ÇÒª\\F€0a‘ì@5Q0[\rÒµ™VEÃ¨>õNK?”•ËU&fâË~\"ÑcÑ5f´†úØŒQËðŸ•ÕÔ0ëõ¬¤u4ò¬¤gŠÖ±ºÒWÃúµå¬¨±‰¬§SÂß:·=\nŸÌ\n.Òî-ÙŽhbY.åX­Ñä•øTQ’~•!C´‚ê)Ý‰#»¸†Ökhç‘ Ÿi–0Ä+íé‘ßÖŽ…i¥ÝCûRôÚˆlä–ß&Y†§ãŸÒ²°hØÅ€\0äö©k@A³qù9¦â¶t¹ô=zß±E<e¼›”Ê©0üsF•¡Üë:¬1„YneX£f8]Ìxü)9¥{ìZƒf=[Òõ½R¶Ôldò®mäFøÎ?­h¦r\'’ÜBeur›“‘ÁÆAVÍƒo§QÅD\'’í×ð.¤lR£-Ì=2Æ=kT\"úî;çóí¿ }¤¨>€¶{f«\"v‚9#Ë³ÿ\0\0S=kÔ,þ@\ríÚª…ÀTžs]f•¥hzRÜ_´}¢/\"]à°+qÏÀí\\³Å[áFjÓ§¹âòxjY%ŠÖXÎ	q“Û\0u­˜¼=Ìqý¬ …WyeýOsúW²­Å…–œM¬.Ö\n\"Æ<àpzVMÞ¯%Ìe@ö@øÖ¯^ZZÄB¼¦ô††¿Â‡yD÷SÇ\nŒm‰r¨úŸð­5ð6…hÎ÷‰–ÉÝŸË¥\ZŒÅSt¬ÅF9lçëL’îI,qéš•\nûÒ2pÄ¹|I!ßgÓl—e­P:t_åTn%váBF?Ù®ç<Ô,rk¢Q:©Q¶²w+›uc—voÆœ±Æ¤á\0÷©vç¥#”„eÍmvt¥Ø3ØQš€_[‚Û~µ2²?(Àj.˜Ü_PÅ=@ \nxéTHÂ85‡pÍ{™XƒœGHßŽ¤ãô­¹ÕšÖ`½Jc×ÆÒâ“päI\"®$³>Õ®\'Oô¨¡X€#`NsšÓÒœ$òÚ«ï‰@xŽsòšŠÞ[YÜ¢J’îB~VÆ©«z=¶ùeºPDxEžê;ÓèO¡ iqÚ¥ÛQÏ,VP<òœ*ŒóR6G<‹l¹nXô‘4Ï3eÏáX—~,·y•$“ÇaSiº„ÚšÉ(ŒG\Z£œä÷¥$Ù¬-ÍS•O,ÔÕ-^g³Óe”9~UÇ©®.Iå”æI]¿Þbi*e:‡ ,±¸ÜŒgªóUïo’ÆÝ¦eb\0õ&—f¶úm¼dìýO?Ö²üY ŽÒ‡Ÿ?€ýzjó²”Þ\'™¸†SêÇ5¥ ø–î;µIv²¿8W1cS\\làl}qÅt‡M‰î,î¢“,)¼n `Òš[\ZÑnüÇ¢ÀÐßÛùÐ}îâ­ÁÎé—’Y\\‰ü¸ù—ûÕÕÎRhæUºÖ*VvgLé¦¹â$N)vbjcg ŸÒ¬´{SåÐì(Ý¢)ŠÕy¶8ç¿eã?ÄI‚§²¶ûEâ0‰ó55%q8¹I!îßÙ:9cÅÄ½?Ï°®*ð±$ä0=k¢×¯EÕã ?»å_Zånd;™v•ÅsÂíór´b¢Œ½B@,ïœ*…Ï¹®)¡9åÅv:™`™OSŒÆ¹¥·’õq³ýÐMvRvG\"<ÖeDS‡F!È5êðE’ŒTšó˜4¹$`d4Ï>¿•uÿ\0ÛRG¢ÇÊ€5£‘Èé·±¯x²œcøý+È˜|ÕÛÜê7WD#·Èz¨8ÏåYÉ¦ÀÎs\n“ž˜£˜&cèñ±Õ-¤\0•I˜ú\0kÐßT²Œs:þÖ\nY*®…‚¡’ÜñÍ×¤º³gR¼ZtÐÂ$Lî#µrQéS3`íQë]lÙ°V=UTFVr“LÞ”#mè4¨—†•Øÿ\0²´VÕœYX.sJ+	I&vF¤í¡ÂƒJPÃ¥3\0“ƒùÒñþ5ØyZ“\0RNsGšWn9Ï¨ri\r	I@$®9Päf¤³DkWÃCþÇbfûA—Æ3ž½;V;¨2xç­[\0–ÅU—†>´¢’Ø%±§¬ø~mÓL¹šx%\Z„z$m–z\rÃ¶{}\rbæžY›$ñSéíhº¹¿\röO5|â½Bgœ~ªWK]L÷*ñGJ½®Ë¦v÷û#yÓüæû6ìä¦xëÏçYáfhŒ©lS‚ØÈ©=.<+\'$sëUÿ\0³ç’q1³³}ÕQ’k¨Ñô)õu‚+{v’MÛ¥#å zNå^¥£|3½mMoæX\"…\"ò¢†u2•üžO­q×ÇFŽM£‡RW“²<wÃv:Å–³öë,ÛÝi§Ï&HØ…eçiÀ8Îç®7‡nï¬%Õïcx¦¼¸>Jª¬IËqÀz`\ZúJøu¤iöóÃqs5Ê\\6ù‘˜*¹ú(Ù­X-ü9 (¶Ñ!hŒ‘\\RÌ*ÉûªÅ¨QŽ‰6x×Ã[¥‹K¶‚ÇíQ¼K<×VèCç(K0{Õ½Â{ûÛä¸haŽÖ0¥bìª=qÇášô»¯C¯Ù¡R¹ù‹pqíYº‡‰š{säîŠR~ú·QéŽ•¶­\'¹jNß	ÉÇðºÃLnïÁÞ0À8ôÀíøÖ|úN¦Ì¿d¶ÞW£Œ~u±u-õÝ­ÅÛ6è¡*$d=7:õô¬7“Ìä6EuÐRzÉÜ™IØ±ks^@n-‘­•Á‘%—<€jºA=ÝðŠÛ{ù­µ\"\rŽ½Oõ¦…9\' ¡e*êÑ±AS‚\ruZÚ¢Û\'Êü¼†^zŠ°²¿­AdöË17Q4‰±€\nÛHl§ð85bÞÚi\"–U]ñÄ9Â	\0}y#¥LµÜç”aÁÉVûPód·…Ã˜R$üÇñ5~5R¹ç¥sR:ÓsùÙfãž¼ÃŠ!ÈƒÖÆÝü1]ºÚ‘qi’C«|è½FáÓ§¥]Œ‰H9‘\\í½œ¶VkqJ QÜý9Ïá[ºb¸Ò­D™ÝåƒÍSI o ®™5ÌœU…Û\n95Júáa&4äŽ´âÍc«°—i\n•NZ²å‘¥$±ëC°$’ÕJëRµ´`³K‚F@$Ò»–Ç\\b¢‹G¥:0cmÊH>ÕVÊýu\ræÞ7Ú§˜c5S[Ô¤Ó£DB¾sóëëMEËK5¦ »‚\\”ÿ\0íZo 9FèGzóï5ÍGÈšíÖ0¥Š¡\nOÓØøP–Óu…ó3ÄÆÄõB8ÏÒ´Ö+Sf¦ô5¶Œ\nÉ¹Ñ‹ý™ÐG!ËC Ê“øVÔÑ42úŽÍê)\0«LÆQkFbZh‹¶áãX÷c…vƒ“žO\\tâ·U\"(\n\0©ädS›d¤(@zö®+Æ\Z¦ûCm…cµG¯¯ù÷®Âþ³YžNµyOˆds| çdCñäÿ\0JIëbÔ.¹Œ®ü× hödÒáLaŠîo©æ¸&Ý.õk[yNIŸÎ½b;$îùúU2v8?Üík{P{~ƒúÖ™lo5( UÈw†?‡¿éW¼S‘â;´$•B¡G Úõ©ü1âHsÐ£ütÐ6´;eúm8®Å3´Ú³BÄ+·ñêkÔ$žÞÙ7K,q¨îÄ\nóæÖçž)0U—x\0ÿ\0*sÚ7†T—8e<\nêôçÙvñ’¥¹ük\r6îâ%”F3Ñ˜õ®‚ÎÜÃ\'R$TKVtÅ(ÃBô#8?­oè_½kI?Õ¾v}kÝJ²®ÐK‹Ö2„‘Ñ	òêÎ¾•\\«‘éS<{º`Sâš+ˆãW!×5!\\ž\0ÕÍ”{˜‚™cíL35Žsq‘»R=É«2£…cx†qŸ©|š—ïh?‡Þ1wožk2ûçmÃ¯LúÖŒy+ìR¹Q¼‘ÓÒ®1ÔÊr÷L×‹v2½ñSÁo–Q“Ô1Od)ÏqV-p%çÓü+T•Îw-q\0ã°&•á\0R^j:}•Ì±Êe2äþR—ÄÖÊ?udXŽìØÿ\0\ZÙEœÎ¢-4Jzša9?!ë×…\'Šn˜Ÿ.(#Øš†ÿ\0W½[™\\0\0ðUÈO´:´L/;Wñªw\rmD—Q.=ÍqÒÞ\\J2ò»g³15\\ÈÍÆi¨Ø—6zT 8ãF,¦3ƒê*L¢“š»bwiÖmŽ±õüUA˜”uÀ¬*^ú4…›	¼‰³Õp(¤¶_‘˜ûçErÊ7gdocÎÇ¤o˜Œñï[^$ðçöér¥äWQ_Ú-Â´ÂNASô#ùÖ2#|¤}k¹II]fÛŠ4 Ténä\0H5<vê½I8 zÇœÔƒ¶ji\"AÀÇ4À O›)j=sçÒ«ÞÂÑ¦åRr}:U¨Hó:“Z ì Œdt¨riš¨óDÇ°Ñ5MA·[ÙÊéŽéŸZÚ‡ÀWÌ¢;‹‹X9%›“íÞ´¬î&·s¶g\n„U–¹,O\\š‰JmèÅbÞxVÞÂä›í{×ª&\0>•©eq-ž‰s¤ÛÁ\nZÜÈ’I¼e‰^Ÿ…,®Iž)p»‰Àõ4^êÏRZ×AúrOk{¶÷Om a†ˆíÅw·šÎ£¦^Kiqr³¼GkI	ÜçÏÿ\0^¸§ˆ¹Pà°5©fKû×=zjz²¡¦çQý¯=âƒç³®qYz†©ö]Þcœ=Éô«hÑ=”qe\nä™ÇÞ*@ù~œVeÅ…Ö ÷°ÛB·E\ZÊsÃ*¸õ\'#ò®JTãÏ©«zhA&¥ÌX*ë \'(áŠcûÃ¨«Ë#}™X‘’+›³Ó®m,$½ŠÜˆÄ¦ðrG#ò&ºX£Ú4u*ê 7ÖºgÇbS}Jm3À9Ã0¨¦Ælá·¹kˆ˜Ìê<–VÆÖÈê:ŒÕ—´òì¥»|ˆ×…÷æ¹»»¿6Lg\0v­ Õ´\'•¶Z-ywoq41†ÝCJÊGÊ	À8ëÔŠÍƒîG`}E&§’0iÙƒkŸ˜g8>¼â¦°¾µ¸³»Å£Èî¡a˜’»0$ã¸ÆG#½6¥¹¢åZ!¾u J7/¯zÝ·,ÖâHe-ŒÐ×ÒßÍgq=˜‚E‚hàqŸ˜³îÆqò‘ZvRê:¡n.äÃsïbQÂyÜ\rØÂ½’¼NÅZ±¬kÙ÷–isË\0??Î±® 6Z+ÃÓ¥Á”Ë	*#ëÀäxÁ­•Ub(ãr·¨©¢w·ÞÈå)S´ã ŽEEí±ÍHç4m:{èópìmÉìWnóè£ÓÞ·å[ÐU‹TUƒ .8‹ujÐÀàle-×©â¦SÖìp‹”ìW½h´}mBäíÚ¹÷öÜšò)uMKS»Ú’°2¶48Æ{WAñÅÛ\Zöu£ƒcjÜ²ž%“×è:Æ—ÂZ)XÍüÉó¿:ZÚ’q4ºp§yZ%Ë{8ôÍ8´ï»bî’Fîk‰¹–m_T%—•¶Æ¾ƒ°­¿kQÜ°´4kÌ®¼†>Ÿ…jø;ÃŠ¶ñê“:–‘v¸û£=~µ¤}ÕÌÍ\\9§Ê‹Öv0i:hBÀ$JYÜ÷=Íp·ó^i®UXÈ$Ts„<×ù×Mã[«ˆ¥M>2	#;­ÉãéÅr–Ñ˜HŒC?Cš#µÙ¤â¤ùc±»c¦K kÖ&FÈ…²;Et’1šF•ñ½º:Ñwö}NK;ÄˆRS²0ˆ€ûÔ:—v:–FÍm:oµX˜XæXFW=Jú~ü|†³ìdû-ÜNFpÜö=kbH6HÃ<ÅiÐàÄÓµ¤B\"‘@iÔŠ¤Ssåî@Mhq­t1µYŒ·EùP`W­[‘xNÜï\0ôï]SeÉlòNMA$d:çŒñšÅÝ»ž…\nŠÓ]OK„ÅªAs$$$.‰\\p+¶¾Öµ«IkfóIœ\'h¬Û˜@‰ÉçƒMñ xfåÇgL~b¶†§%v›¹Ï]ÙO©ÍqtÑC+ºåCŒ1Û>•­áÝ:ÒsG+®>uŽr+KÃiƒ¸’3ÿ\0¡WUàà¦;Áîÿ\0Z«ëa%û¾cÅ	i£ÚWs +Éö5óF–öŽ–‘Ñdy„¶9\"¯øâ—Uµ#10ôQžõ]ôËÉtû\0-Üˆ†ßòãæoZÄÃW©»d¾~ƒm3*‚r0£\0rGJX”léÐ‘RØBÐèFåK+v°#©ô¦ÅÃH=?g\'©¤v%CœÞ¤”òÅ1	©[•¬ÝïsDô:\rNÒ\"Û·8\'Ô8ÀÏ½qþ8ÔQ}Oôÿ\0ëWxP‚\rsÖÑèva¥xêUhFã\\_ˆØ”P{µz	‰¶ä×k§uùÇN–£¯+ÇC=2##8ªÒsš›?.DÙ­Ò9®Ws…_fÅOßbFp*aèH5<]OÐÕGr$ô8ß®Ízãöÿ\0!XŒ§ë«ñ7•²K@™å˜ãò‘5ÀVÄ1D˜ã>X?Ï5ÔŽ&Ì•F\'\n¤šÒ»°¹–à¸‰ö•Sœ`}ÑÜÓ^îãëG¢¿Ë£rDv–Ì(I\'¯Ê)“qžÀüóÄƒÞ@AšO²[Æ2×Aý£ŒŸçŠ„H»‘É\0PÓØÐ#Ñ4¦WÑí\nä¨Paè1QD	Nqœ:D}þ·9Ç\'§ÔÔÐäù€s‰\Z¹êt5ÁDh€ †ÎsEHÑ‚ÙÇ>´V\Zz£‹\ZA€y^€ŸåIçF§–çÐTB4yö¹ cµ[†(~l\'#ŽGC]IXóÛ¹¯ww Éàë4´¶—ûqn_Îa¸)‹g·\\cðsÔV\"Ö*…÷\"®ÇÂü©åÛìûÇ4EYh+û%Ü–Ü%´¯L²\"’©ž„žÕM\\\0æµàÖo4Û;«{i¶Çy†d#!”ÿ\0_zÈ§µg­ÝÍ¡±4#÷«×­j $úf—IµÓ&Ó¯¤¹¾{{øU^Ù\ne%çæSÜt¨ZWÁr§ûµ›zØÞ;XÝ<—\n²†ÈRFG­l}ÑXö‹Ï¹!y °À8ôüë¤Ò¬Öêà´¼BŸ3ÑQ¥©”Se@rïÓ·½gÝ]4ÌUx_JM[R€Ýù1Ï›Ž@„î=†+:îìÚF¦¾êç“JÍìZIjÉü°[§>µ·¢^ÇâEzÌ ”È¼”÷Çp=+!(´7WEm¢êåkx\'Ã·~/ÔäsrÖöd çÐ®:ÖUšŒ“ÐÑZNÇ Gjö²yrnVC•`z0=Áª÷ú^©+5Ö&ÉäˆÃ\"«b§Ðž*_~Á>•?Í=œ’$EŽOÊNWžÇ¨ÿ\0ëÖ“\\­¬@®æ~áy¯*5$¥x—([Ýf‹áËû{µ¼×çk‚¤†IDŒøé’2\0ýM]\Zk\\ßˆ o.6bXB¯ãÍO.¨ßh@Á„.0wnÀýyý=k„ñWŒ$§Ò4’ìeù\'™9%{¢ã×¹öÇ­tAU«\"4‰oâ¹qouÿ\0ý˜TDTg–&Ýæ—o§©üO5oi™hnîÜ¼¤u\'8ö¶¶ñéËy~J»aTNÞ:}qI-ÓøÏQ@©¤°¤xEåñÆãêÇ×é^„)ò®U±›i™¶Ö³k—í4¹XóŽÃÐV†±v¶–&ÚÌ®AÛ€Óñ­@|;caŸu¤ñeÈNboîžy=ó\\Ì0\\Y\\G,‚D‘¶Ê¥Á‡PÞâ¯›KšÑ£í%ËÜ±?‡ï4«;KéÆaT>‡ðÿ\0<W_q¬E¬Øiñ<0	\"Mï*®¹õ>:gŠ<A§^hmk	.J$¥@8CÁëøÖ‘¸Å‡ø€¬R”×<´/NšjœwG i­\ZÁªOç±‹Î\\9!“ß ?[¸Œ£•9‚¡¥s¶S›[ˆî@\'Ë`N{Žÿ\0¥vlÑËv“ÎŸhBÄ±f#~{ä~uŒegcË’åŸ¨ù®-®,-Å½¸‰Õ¹ïZÆñ%•Àð]íÅ¼ž\\ê7†oFŠ–­„·Á\Z/ÍÔ÷¨|Hámb°P\n¸ÃÓ\0VNvjÇFÒ£}	±TP·fPÊ²©*z‘^ÂDÏÊªÒ¹TðÖŸ»Â4„üíÇä+Aà&çœ~Bºå]=fŽ	7fìyþ¡¦Ïi{\"É….v±Ôsô®³Eñ=†•ok2LÒF¤Šê}O¥Oâ¨Téö¿1$Éÿ\0²\næ“I¸™‡“²3ò!?Ê¶Œ¹£¨ªá£NvJåßÞÅ¬¼ÄñH$ê?ZÄAðC±úþ5ÔÇáûÙmaClêÀ¶C¸éëQ¿†¼‡ÍÍå”Ñåçò©S[6o*Jš5t˜GöT\rù;}‡JÐXÈÏ5™m¶ŸpÜ­Ä[›£¯\"®ŒöŠÉniY¾[Ú09\'Ÿ¥m)2ÛÃ\'RPgê8¬×ˆí$ðiéÃ}Š)þEkï£ÍÄFôdûí ä\n¯~B[IêW ÑàñÖ³µ<ù\\]2vG•OY~JŠVÂgÑªÚ®*ˆÁ½Hýk3¢öeY×0¸?Ý4íkÊÿ\0„näÜ+´ca!÷‡~iÒaá$«LÖ‘¥ð­â*–b±à§æ¥3\n½kO¹±]2ùá²ùPÇ‘$¥·dœg®ÂWBçía`Ž%P¼\"ã×ó®_JÓ¯—KÔì’©qÝË·8nzþ5ÐxkvšÓý£i2EXØ1Ï=@<U½ÉMr´È¼k{qe5ªÃ4ˆ¯ÎÆ#8>Õ…u+Í¤iÒ;’JÉ’yþ3[þ5·µ™¬ZæñmÀV÷e‹téŠÆšM&\r\"Ã{ÝL€Èb\'NrN:Ñk¡FvgC¢|þ¹ßÎ•>[‡Áà€¥.…4xx5´o~k\0®ÛoaO·R^+ÇÊàœw¬äµ5RV%Ny4þ¢œðÉ	\"\'¦h³e­Mø›Ä?ÚÈ×§Åj	É¯0ðã«ÄÚZõûdýÊœu¬*+´kÎá¼–ÃiÀí^I®¦ÝIý‰þf½ªH‰\\×Žxvê²ÿ\0¼ßÎŠz1B\\ñ0Èê)¤T§¥DÜÖ·™‘NpçÞžpœJqéQJ¢!zÓOQIhs¾,ÉÕ#eïþf²\'³™âÝ%ÜË5$Ê»`Ò\0¬m \0d¯jp{¦êè°­ý¢G*¥\'Ðàí¼;¬M.ï²HÖBùÖ”¾¾ºXwIE#U;Ÿ< 5Õærs;œúqQ½œlß0gú±©u‘J„Žu|%Yõ8ÓøW¯æE8x{DI?yw<Ì?ºF?A]\nÙÂœˆÐaOTQÐ\n—_±k\rÝ”cxm¬–ÒÎ	|¡ÈÈ?Ö¤€8/”Ú¥²«¸€E3\n;`Vr¨äoN’ƒ#Éëš)åsÐÑSs[\"‚%9_á©!”ª³N3PG+`Â‚Ê(Éçšèæ8TQ¡m(h–©ÌYbXýGåU¡xàW#Ž•\\\\J÷F\\õÅ8Ë›beW©zã¤cÛšŒuúSî›æOP*5>µ,Ö;\"°Ç>Õ¢¶ÃËR–àñÒ¨Ú¯_JÔ<€¹Ç<zÂmÜèŠº5â¾•44Ò%Øö±JfFq–RFÐõÇµbßx†åéZ^ìÊvÜM#¨QÐñßÿ\0×X÷ú¤ú­ÒØ@>Î¬ÛX¹Á\'ÐûT“Æ<7f\n¬—’¦F¥Z¦º˜s[bþ¹c¦øSU¸ŠÆí/ÆG“\'r¤g·×éMÒ´‹™ÌÚ¥ì2È#_1¾L¬kêÞƒëÅCáë8ïckû¡æÜy„ÇÀÿ\0\Zck\Z–Ÿªj1CtÉèöÒÆQ£a‚0}x9¢Ií}K¦¹š±«¥hÞ/»šIAmUs–úZØðV°<-«ÏêÂ2¦)vpxýsúÕë¯¤iQÉbgVGnž‡ŸËò©5‰4­CW·ºÓ\'•U‘ã}ÏûÌ|Ø\'·½yõyª·ü\'jQ¤Ü7¹Ü[ßÍw0¼ófvâ@ã<~U¨`ßp­˜‘pxÿ\0¬r?\nç´KYgµ–úWFŽ?6[§ËžŸtZ5ìoi\"Èr•äpÁôêMy:rv\n‰5uÐ‹RÓRúÂâÈã÷ÈP¸ê±úæ¼NÂÊëHñh³ž&C#G\"žÄ~]ëè¤·Më!*NãøW›ë—âçÄ×7ìà}ìú«³^QæIh`â¤ìÎgÄo4ógÌW¹qšÇÐçM¾rY™Ûøð­ûÜ<Þ©[¨þÐÀ{W§J¤¤¬Å*qJä\ZÔ÷:…Íµ¬¦$!°Í“Ç-†ýn`×“}¥­¡Ž$\'#j(!Gn€^ôjQçÄ6[Tœ,dàtäÕŸA,_kó#dÎÜnzÖòŠ±„*J2÷t)jqióêýŠÙâ!¾dœÐÇØÓéZŸÙÙ·Ob9Œ,cßnF#Ðõ¬Yac¨j*.\"BÙ\\’GÌ=«kF¹›O[k‹iq,X(àt>¸5•EÊ’F°|Þñƒ^=«¬ÓXÏ¢Âùå@—ËÚÉno´DÒ3FBØÃö\'ÔJë|5“AwÈ!X€„ò{ñ\\S|ªç.)rÂý™§\nn‚\0à×?®IæjKÜõÿ\0>•ÖÜÚ½­°Þ›X(Èô®3R¾séYC[³·(éN_#9°Ûˆ\0sÐS~é»pjeP>¼SvWfR=ÚIÞ#uÛ™,4ˆî\"	æP.q•á\\e×Š5i	F»aþâªŸÌ×eâ´Sáø•œ\"ù‹Éçåö®\nHtíÄµÅÃ?÷D@ÏqþUÙM\'LëÎJv‹.£uq§ÂÓ\\Lù’@w¹là\'¯Ö©ˆuÁïZ¤ÙE¥G ´‘ÕfuýäÃ©Uç\0Ž?ÎjŸö¤@€š}²óÔ©oýš¤•ôDJ«å³‘Ûxx–Ða-Éó$íþÕk*’=\nòESÐ˜\\h²`Ïª\0Î}iÃmù—8Ícy—(óA1Ø°O=[ëZZD{­ýê¨è<²“Š×Ð#Ýlãù«ZzÔ‰ÁŠ\\¸i·ýj#EÏJÃÖ€ÞÊ»)-p¹\\®¼»IEvUVG„÷äa„%:à{TR/ÊEn[[DÖêÛÈæ—ìp‰7úT%¡¤çï3˜¶¶º’,4M»%FjÕÖŸ>=½¶b¹tUFß·Œò+¡1*“µq““ïP_\\›;c(RØ# U­e.c¶ðN¢m.¢¾ÔUÍÂ‘¹ñ†<ãÒµ¼?á4Ñ$’E»i\ZEƒ&áÍbø‡ÅLj@ùw\0þµ¥ê·Ž‚íîÉù@1ü±Å^¤åÿ\0‡týWÉ7Ñ|œíŠŽqéô§Gáí&Â±çjºî=zÓt=Xj1m.ÇFÇøÖÇ~)Ul­¢æ8cAè«ùT»1Ó©[§N*>(ëûôõ™~ôm×ØÖ\Z†]UØß£Ì=®y¢Ä@ŽµÆåï5æzp§xE®ÅÝcTˆÿ\0´?{m’î¶ŒûW‰é-ò¿¦ë^Ý¦ö6A§óI#,N&tNExÏŠ£ÛªÊ?é£WµIÂí^/â‡jH:\ZH(½ÂësaL#ŸZ›F@Š“¦ÄL¹ç<Q´ÅH@ÏJúÐI”ð€ã#ñ©Bõ4 qI±ØaíÓµ0åºT¼Ÿ ¦qJà3n;“õ£>¸4æÜE7 hiÚ9Rg=9§c=‡ãAëÚ™IÁ=§ÜÑSqèyàŒî cÓŸJp\\¶ðj/0Æå€Îz‘Yç$*uå±]28ccZÅ\"‚UŠæ(ÜIó\rÌ÷ü«BæÖÆ{c,´R*–n„\ZÁ[`G9ÿ\0õVÄ>sA”*«åòk’QjjwÔè½ãÊgÜýÅÏ\\Ôq¡=ªõÍ¹’/4²®Þpz·Ò¨«œóÒº”“2³E»@|ôõ¯ÃË‚\0ôÇ‹jÌnßŠÞT*ë’\rcWs¦ŸÂS‡ÃÐÝjßnyJD¬”Iúýi×ö~‰ç‘å©Ê*žO^MmBÂ+)ñÅg¢Œ)\0€FEg)É;Ü)Æ/tVµ¶k5Xaù#Ü1ŽõŸâHÄZŒ%\0Ve%ŠŒgšÖ‘%I£ÞU”°*Tÿ\0N¢«ë÷[K	…ö3îýÿ\0^ª–²¸«´£dQÒÒy’a:Ë4S(F-–ÀÏ_Ã¯áWl,\'´›lÅp‡ŒÍbÇwu$wIˆ@G?íñ«zlÏs,,Xï„á²~òvüº~Uu ìÙ•9«£ºÒ§ûyç­w~ýåî¦Àr†\"?&¯1´“¨ó6«[Ðw¯MøjÂGÕ\\\rÑ\0=°Õã×…›gEYZ›4¼X>Ï¤I(bÁr8#\'Ö¼ŸV­©Ü›*[’6,¹‡©úæ½Æà`ŸyWú×]NçÞ·ÂE*wó1¥+êGsM>Öéna•çÜ$‰\Z\"§aïÔð¨\"´¸Šh.äÅ¼Ñ)#¨¨$-ª\0%\\þF¬ÛMp×Ky\r¸Rá2v†<g¼\nî¦¬Ç7î”µieÿ\0„›OH¥(ˆ÷*±ÚNîsKà—i\rñs“”þµ§©K©Ý\\ZXG¦Ç-¤r‰¼æŒîR@3ž˜Š›DÓÌvn´Óm¨,Å„Èà+¡\\\0TqsÏ½t7¦§:µÎZh¤“UÔü¸Ý‰ÞÑŸâµ§»Q%]²€7©?•jÞx3P»ÓžêÎé®\'v‘d·-€£p+´žÎqøÕFÒæÒ\"³K¤Q3BÐy^HÃ{äœÖ5*ÂZ\'©µ:rŽ½a8¥z…!/¡0?3Šá¬ö×fÖhYgf>§éõèþE ‘ó;b¸kÙ«f÷}ËÚ†~ÀÙ=\0þuÂj7ÍwÚ€Í”¼vþµÁ^ ûcœµ=\"vðÿ\0¿…—©Qb2I DDNI=\rN©ÏOÎžÐ“êA4ù£¥~+ÃèQ Ÿ1pÒ°ô_µO,¶¥ã,qž@?…uÉopHÌ cŽÿ\0¯[Ú?†nu6ÉšO,¸‚+¢5tåZœµÒ…êODyæ­¢êW’[}’!˜’X.3·ô5EüpÑ®û‹t`9bO<žO\\ŸË¥{Mç‚aµ†Iw´Ê `3*È_\r  ­²sÎvÑ*ÞÍòÉXç…ZUUÔŽWÃ¶CNÓÅšÎ³l$–QÇ<Ö¸Np+i´´¹â«É§¼c(wQY{U\'s®JN<©™òE”$nxV ðÏÇB:ÖKð‡5Òø:-éqîËýk³+ÖÎÖŸ.mu·æj½°)Ò¸_BVü\rz”– !#®+Î<cË¦ôÂ×¡‰iÂèùü¦2~Yv3m\0±ý)XäÑf?Ñéýiç­e‘­UïËÔiëX*ºû&ž.våþ¸ãú×CŒÖv±§FÅ£ÆXr¨î*“2gŒ\\êê/+Ê\0Û\0ÜŠ—M¹¹¤R³£RzÞ–Á­£“´ãpNJK{›‰SÉ³ž¤p+RMßÁ2_e*¤wìúÕÜƒH›¤X5´fY?Ö?oAZ»y¨`0ƒŽÕ¤TØ¨Sš@%Æ?³fSÐ‘T>Ì\raÛWnÎÝ>SÛ\"ªG)’È¨S^m{©»w=Ì¥MziÄ}¯þüÅwzoÄo\rišz[]jjfŒ•Ûm\'ê Šó;É>ÏmrÀdùL£=9â¸çÛ@÷ˆ¾È\0ÅmNn:£\n´ã%i÷}ñoÃ«o\"ÁöÉd*@Û0\\F£{¡kÔ˜Ý¸$`þ5æÆXL¹ûTÄvÿ\08®›GºŽM6HÇ˜R@Ê¨ªRrz™ÆŠ÷\r¨#\rWaX€‘ÅBã-XÅûÇDÒPDAO¥H±œô©â€·850ŒmÆ(”ºØ¬RšzTò!ÃŸ¥BHäg¥…ˆ	9Å0°\'þU+v¨‰ÏCÅZB¸ÂHíA4§­7¿µ?Î)	çÞŽx¤à\ZcL\0ÝEÛš*lUÏ<`,síS[»Ç)0d:TpÃ{•\"¬èC¯ÜÆÓÓ#†:‚‡Ê—ÇµmY¬ÞXIL`·QŽµ–ñMæ|Èd\n0vóü«¤±Öm­¬Ò	Þ4\ró$\\Õ[irtÒZ²¼ ¶.›²8+·{ƒXÎ¨­•ÝŒsšê®nl¥Ò\'–Û©r§¦úÙ®gÉ=†})a¤ìî]h$Õ‡ZÇÒb·Ñ¾ažMcYFcºˆ×Aö—¸`®	çŒö§UûÈ ­>C‹?Ý5°YcÈæ4CŒúgÞ¥¸P-ÜU Ómù‹7Ê>c“\\õdŠ¢Œ‰‡ïâ |¥ÀÖo‰\\	­øNìÓµiÞ¿ïá\'Øc½PÔ-£ÔeFv•¿*õÍtP²³f8”ÞˆÂ†cåÏˆÕ\n è:üÃÖ­isHú„@¶Èà`t«ë¥ÚÄŒÊÛ†æ<çÒ¬ÙÙ[E\"¸·Á^s¼“[Î¬9]Œ)ÒŸ2¹y¨\0œãÒ½_áL{¬5õ‘èkÍb·7RŒ€+Ôþ¢¦|‹Ï\0þUÁÆ¬ÔÑ‰Ò›0üAâË­ZµÐÃ\Z¾AÉcÇÕË8Ü†|±=jÜüÊäwc@\\sé]q§«$s&Ò²3î%³ÓÉ2(àcšO×¬ïd€Pž™èkÄW‹%ãÄåºáO`ãUQ\Z	cŒ1À\\‚2s[ªjÄóˆJz€[¥ClÌöñ;gq@O×a9ozÌ´t:.«ŽûÎ?!RjÃ4,%‰`œ:ƒQiZ1ôsü…³)†{W‘U~õØö(/Ý§ärj²Z^Gs²IÖWÎH#§_¥z‚¹ÑÑñ;gó®^Gà+¡ð·‹´-/³êZŒP¶IÚrÄ º\"¹§cÊÅÂSÃû»Üëõ¨–i8 b¼òí	½p9\0WS©xÃBÖg‚ÛN¿YÉ;v2œîa¼`êmžœ*œBŒ$í±èä”*2RV»¹Q#ì+zÇÂš•äB]±ÄÊù§þ?†4˜ïuyFb„n#Ôç^…·#®\rí#ÌÍ3ÎTeìéoÔáâð…ôg%íOâÂ·ô­2}<îi#Á2®Nk`F;h«ª(©)u<jØúÕ—,Èd„\\(H_OZ`´…z¦ï­ZVïùšÔåRiY\n0‘ô›©iK2›ˆ, |È8õýë`œTeÁÏ¥DéA®Y½Ê…IB\\Ñ<ËP…\n‰cû­Øöö¨\"ñ`ð¥‹Ïö3tÎü\'™°ç×Ò¬ÞJ† ðdb?:á<fAÑP•w-!GEÆ9?y”¦éÉ4}w±z.67&øá¨1>V—b£û­+1þ•x¡üUg-ÔÐG±°B‘¾áŽ¹ýOå^Q\Z2›q×©®‹ÂW)ïmÊmÆ$Ÿ)ÇþÍ^„êJJÌó¨aiÓjqZüÏD±æÍ×ùÔ¦©é÷)ö59uÎGãR4’8Azj¤RµÎ9á+NnQŽ…Ži¦«fô˜óLÝp>‚©UC\'ƒª·ÐuÅµ¼ ¼‘)o^„Ñoio4\0ã½U’IXrç•T˜Á@ç§ÌM?hfè[vt•z)¾tyûëšÅ†T‘ÀgÚO¨­‘ŽÔ{GÑì—VZÞ§€sJ\"’FÊø°ªÏlv\r£\rÄÆ 2ÛN\0ëPêLjœ÷±4©VGŒÈì\n…lñƒšÅŠOÝmÏJlÓ™W¾•jŒæ¹ä›ÖGu	¨+#+_RÖÅyÃ0g­cÇh™ETU=ˆ¹â	g¿å ð+ÒââV]¶ÄsÁvÊ£Rª´É¾ÄÛÏ\'¥]±ƒË‘%G8¡Ò÷\0*Â9ÎjåŒ3¼Ž]\nAï‘SwÎ¬g„¸§hÅYµ²iÉlp9&¬iÚEÅü¸T(êÍÒº!§Kd˜ó¡é‚<®¿­*%¢ÜÓW¹–-qŒU;¸€xäSƒÊ¿§±«ÆÑ¦Ï´ÈTp\0À¬É°3ûÇ#ÜÒ‚»½Å&†Ë&ÜäãŸÂªÊàƒëØÑ!òHúÔËè+¡DÅÈ×Ô\nˆ¸õ ¸ÉÆ)†UHüêìO0»øà\ZNIèj6¸G.£ñ¦}²¢@O·4ìO19õ8£ŸQŠ®×‘\"rÊ£«@ª¯­Øùl	ör·°Ô×SDzŸÊŠÈoYú¿åE±^Ò=Ì$,wu¬**sÃŒ†ùE\nJg y©Ú)\nè¹l³=O½Tô2ŠwFµ•Ò+Æ\ZßaË32\0FOzç|Wnâ¹Ž1±\\ƒÎzò;V¼pÝ+…6j„0Ì„1÷}ª‡‰®–çJ¶™T)ó+ŽT€r?XPÒ¦†õÕéjRÒa³4Ø!2«à“ÜÕk[†þÏ´†=¢Y2ô\0òjAi#¯ï$“/÷0vçò­¤½æÙ0øRE»b|õ5¿n È§9ÈÉCGÒ¤º¼‚3èÃ8Ç½uO¦4\"}™Â†ùYH }qþx®JÓJV: ¯fÝ¦-Xc“ŽŸZÐ–Ø“\"ÑÒÑ¥Âô^µ¥Ì§ûJ?•l_Bâ-@¹ns×šÐª1Ñœ±€:6å!ÖMÃ^Ÿ­G3`à\nÒž3\Zñ´7¿JË}ßu†Ü{æ®ã–…vç¨àt§!çƒÈô¤cÊúš	­Œîu~µ79,zá“ý*×…|geáûËûI/á‹Ì“]ðGû¢³ü;¨5œ­&ÝÛ\"lçüû×ž¤q¨¼˜¸ùåÝÁ\0uúŠÂ6êÉ½6VœR=)É&ŒfšxÔ¬èœ³ø×¤pœ§ˆ4­÷&B¡;°‹’}@¨´‹+‹ÝOÌ0¼p¨Á.1]KÜDCC)ù¢ëxãîã¨\nE_´V°Ô¢‹…\0qŽ*Dô¬ïíHEcôk(û°¹¬Ü‘¤iMô:Í5¶ÙÉŸïä+&öå¼çPxéPÙë @Q­ä\0œñTe¼ŽY˜ä‚IûÃÅÉz³Ôqå¢—Q$|1ÉÀÅy­ýÑ›P‘üÌe‰à{×{rì|Ì¼b¸¥Ž1bF:væ´Ž’dÑ»½ßÜn ®‹¤V9L`^‹+ÿ\0§¹ÏL!\\u­Í ˆ§›p@aÇá]<ò´äõ*?•qI·sèªÅ>V»Ÿƒ®g¸„\ZE}ÈÏ­vˆxë^AitÖò‡Brv5×ÛøÂO(	lÄ¾²mëž•Ù…ÄF\nÒ>g1ËêJ¯´¦¯s±È£5ÆËâ‹¹È!€ßF´4}H\\ÌÆâô’\0 \ZêXøJJ(óg«sHè²—ÔVN¶öÆÔï”‰eUd*Oå\\]ÊA!Ü^äúøñ©­ŽT§Ëk•†Á{u{Ûåÿ\0ô†n8\"¹ë‰YTÊà‰¸>µÇÌ@EÝæÞ›LíçTž8AŒvä×=\\[šÑXõpÙDc5)Êÿ\0!×7Ù6’2¿6Ms^&¾…´¨b“ûˆÁë×ÿ\0¯]Ï½q~*gmHƒ3“Ó?çÊ•äqE(?Cfby`nëŠ·á¦ŽãT}‡îÀÄãê+2æâvµ*Û:Ž+kÁPåu§P»PÜò¯AS[£ÄUd´gO\nª®wsV¾Û,JàzŠ¢/`EÀ‘sõ¤ûRp¿ÝRk7²½¿*²fµ½ú\\6É#1¿oCVL`ö®RïYµµm“Jc€A¯ZøËO¸h¡E–IØ`…^	Ç¹®ŠqÐóëÔmîY¿ÞyH8{ëT×xè{õªsêŒ“6øNIÏ&³.|MäÊÑˆ7mîŠ§va¢ÜÝ!ÉùŠþ´4ë–I9e<)nÇÒ¸ë\\]\\,QÀ€‘žNqZI-ã0;‚óžüh³D¶š;feT%±´šçee¹˜Ìê2~î{\næµ¿j–·MkÂ•Ø7æ1ßÿ\0­Xc[Õ\'•c[‚ \0;Õ8_c8ÍGsÐv®8Å<`wÈì†Ð1Ÿ©ªºþžÉ¢³DJ;:Œ¯¹ÛS¦-ö\'º‰nâkpFçG×V‰¡_êSl‚Û–SÝ!Ú?F‹¦›[¸o&‘±Š~cÇ\'Ö¾‹Ñ¯-?²­–7@5^ƒj•É\'dì)Ô’ísÍ!øs¨Îæ³Úp82\0 j+ŸÍ¡Z\\=Ì-%@ÉÈ<ö¯^këqÆòO²šæ|Y<7ÃÍÐ®~JšÐ§Ms©]Š•iÉò¸èp–þ2²Ó!GnìÇ“Ž#K­ß;6Ñ)<ÿ\0­\'ÿ\0e®cW³Hç$a¸®‚â!…>Â±§\ZrÔÙÊFF¡¨^Ço,äFB)m \Zä¦ñ]Û–(Çç]…ì>e¤Éýä\"¼ÅÔ†9õ®êqcš¤åÜè4½bëPÔ	_j0?pô÷»öUÁI[êßáŠã4y:µ³vß·óãú×wÏz¹Y38¶Ñ­ÀÐé,êëŒç¥r\rs3òesÿ\0¯A½…n,¦Œ÷B+ÎÙN{UÀSOröuäê*ÇiÜ}k¿X†8æ*#ézMÇÚôøf=YF~½ÿ\0Zš½Â–ºê6¾uŒ‘C‚+Í]Lra†\Zõ¹#ßW›ø‚ØÁ©»òIóëE)tU¡œ(¥Oz+VŒN…BÃg`u\'µMæ \nà‚Ÿ{#¡ÎË}r¬‘¬›bÀ¹úÓßQÙùL2s1zšçpÓC®2WÕ¼WP]È¶Ï±¾2ŽÃ\nOl×âÈEµâÀ™±ZE###ðÛ}fòÖOÝÎNÐ0[1éš««_Ë}uæM‚çvÐþºŠ4œ*\\Ö½hÔ§¡kIœÃÜòTs×nIÇçZ—ÑË$l¹]¤uì+íc€¡p9{ÿ\07ÏÈ8$ñ×Ö¶”.îs*¼ºƒá}^Æ=fÞ©|¥\r´1S‘ê+ÓE¬wiæ[ºJ›±¹Ÿ¨¯Ÿ!}²DÑÅ¿„z×½ü*kk½m•Ù¦;Î¾`!:\01Œóý5çb©;¦ŽÈT\\­³\\‡ÊÔ„l\0l`þ•«~¸8ÛÇ\0þýj_Úâ&ÞZdùxì ÷úU½J(®6~f_Lv&¸±Î)XvœnqwÌTÊ¾Š&²åÉb0z\n×Ôcvi–«¸÷‰èséY\\Hmq[ÒØSÜ¬ÅIÏ·ð09ÅFä  àJƒûõÕc—¡šHc“Ër¥—o•Î#‚fU?2œt?á[^bíÀlŸ­Z‹ÂzÖªÍ=®y$2 dhÔmn=qõ©º‹×©KU{’økÆZ“ëVÖBhä…²\nI\nž\0\'®3[Ú•üwìÖ°ÆàL_(?‡5£øG[Ò5õ¹Ôtû›x#ˆyåÎ1ŒôïOkØ.n$H%YHC’}«9ÒŠ•âš{–bxnnv¿÷O¥>[EòØúV-íô6Zv1–û¼sS\'‰à¸²o*9]ÀÚX.?uSŽ—0¨õÑŽl+¹Î{U‹k¬0YWå?Åé\\ôþ Ž&Ç’Å‡©¤µÔ®n—tvØSÐ–ëWË5­†§\r®vÊŠpÎk\ZY^IF\n£Û­bÝx®æÁ>Ê‰Ž ü£Ó­ZÒEåÔkœF¬2Š£’=NhœZÅ\nšØÓQòà×:[Ù£T\rŒ“ÖµõÍrK)¾Íg.]Ö>Áô«:—a©ÛÇy¨:yÏÙ<·<`vâ¦0q÷™Ñ	©».…67—ðÅöhØÊê¹\rêkÒoGrÄzÊ‹NÐ´Ý·©k“oón	9ø¬Í&ÑüSâ‹Éý”>Hn˜þüº×5h«\\ö©VçŠ]Ž•„R½ô0±G‡U-Èü*æ¯qk£éäŒ4î6Ä™ý~‚¸Û;5+åAy¦n§×Ö¹;h¥R.ODŽÎÇ}ê-¾t³Æj{»ïì£ÚJ‚ùÂ©â¶ímtÝIÜê<¨W’z±ÿ\0kƒ½¼“UÔZvçá#QÐv¡Êç&ý¦¤´÷S£ÓõvÕ®ÌIæ3mË;{óW.mÖÞIn‘U$óÓò­=\nÆ-LXÊ©žOšFÇOÂ°¼a«!ˆXÅí†—‡aøÿ\0ž´u9a/m‰ötU£ýjróëò±\";lg¡\'?á[vVwRÙ¤·(Êî3µxÀíYÚš/.üùAòb9ÁxöÓ_ê	mo$Òð‘Œÿ\0õªÓg£Šœa5N’×©Åx£P—Lò¡¶b&nX¶åþqYú&ž<Dý£>í­¹Fy+Ó Ç¡¨âµ¹ñW‰£·ääù÷uü…o|:Ñí%ñ¨“F¯R4h¬2?Ï¥uÁ+×¬©G]ÒÔ¿kà­ü¦Åd\0d‚çÖ²üIg¦hzä:ti|ÊžI¹ô¯R±ðüzUô·/,ÓËùw(V¾OLWüQ×ôíGT‚ÖÂåeŽÞkEÊgŒsß½oÔ#ÛF»qŽÝÎGÃFïXYf8óõíúóøWxîK1À\'Ú²ü3\r…¦’$û\\IŽçÄƒ@Ïz_Ý¥®’Ë\r÷*àöî/çZ9©;èJ\nç\r©^íBkƒÑÛè:Òµ<+o¾öI±òÄ¸Sÿ\0ÖÍ`8+]ç…ì\Z†\Zcæ§oÓùÖÒiDàŒ\\çbÓ„Š)Cò(,O ×žKrf•äqË1$zî¼M\'Ùô¦‰Ns°};ÿ\0Ÿzá~Ìy8¢›êMhI;…-|ï>ä¯§ß©þ•Õ,j£$U-ÌYiFÃÃ{}O?çéSjs­¶<¹ÁBýOõ©“»ƒHà5þ×©\\L:3œ}:Ò¬è6Þ~³h„tpÇè¼ÿ\0J§å€kÂp)Ôžsÿ\0,ã8úž?–kI;#¦å©ßÃŒŠƒÄ>Áoþ)3ùBNªk;\\ºó%·Œ€šóª¦Îø»\"Ýµ¾ë!\"¶9£Ýøµ{^\n¥„ /;yW‡í¾Ñá­F^¾\\Öÿ\0ú{ªm·AþÍF“”¹YÏ‰•–…!i\'Ú¬xì+ÅD¤p¹þö®±†F+œñd%´ÆaÕUä*ñXgmˆ¡QÊ¢¹ãºÃïv8ã5ª²‰-!oTÊ¹ýJà’@¹¦·‰l-¬bF—{…û±Œÿ\0õ«<<]ŽÙ&Ù¯ 5æ×Öþ]ìèáÍkÜøºv8¶zÈrJÀžâ{¹šI\\–c“Ž+¾7Žær¡)ŒÝäº¾pTäWC/ŠÓŠÑÛ×sÿ\0\ZçTåBÒ8è=+OˆÓZ½Mÿ\0_])JÄ‡¨N§ñ¬îJSHjÑŒ¦i8ÀZÞÑ<Ký	‚HK+6GÏŒz×<Àö¦€i´¤¬ÉŠIÜõ[mkN¹QåÝÇŸF8þu“â==.mKÆAeù—ýEp!™yEXŽþxøW8ö8¬U\'thùd¬É<QH.U‰%ˆ\'ÔfŠ×™ö2ú¿š%Ôæb›ŒA¿w·>Øì:Ö`%fU.JÐ}à+ÓµO\rÙI5ó-»|¬¦?%°€\0Ksø}=ëˆ}–áQ²7õùzW&NQ;19mhË™j™šLŒ¢PF8f¨îeãaŒƒ«RÙÜZÎU”‡iÝUµãYP&HÇJé‹Mœ2„£˜¨IqÆîjh­CÊÀŒ€jå¥”Mn’‘»#¿jTFÞÇœg®:Ôº‹T†éJ6¿R/±¢€Wž+Õ~ÙÍˆŒ«¹¡’6WùqÏNÕÁÙé’ß°c!²}«Ó¼7â;[G§ÃäH²€î6ÉÆ=x®*µÒi6wG\r/gÌ–åŸ\\ÜZxÉfŽ	@I®T2F{þU…â_Ëeh9Û…WC¹àÕŒ|mœÿ\0?ŸtGLð¿á^s¦¥u-Ö¡qò¯%{·°ö¬áAW—µ¨´œ©ÅB/Sf\rwUÕwË+Åø‚ã?eO©]]Þy2<˜êÇúý)]®µ‡ZÆ!´^3Ž?ð«¬Öš¿—ß;Gv>þÕ×F-{î¤¥Ôlì–î¥2Jz\0q“ííU´­>÷U˜Í#¼vùè¬yöãVl´Iõ	þÙ©’©ÔFxãú\nØ[É/.cÒ´h÷Ìä d/ÓüiJ§*j;Ž1rw–Å{‹\'¹¸]3Mµó®œ|Û%Gøÿ\0*ö„–Réþ’\"7räþ\0/ó¯øKÁV~Ðçy6Ë$Lgœöã=¿bé>2¶Ñ´)mmPKuö‰6åHDRz“ßœð?JÁ¶¥ge¿˜¥/hœ`_ˆ\Z„©l¶1ªeRCûƒ¦H¯½¹°ðÍ¡Ž0áùÇv>§ÐUßxÍšYLr}¢îCóHN@?ç·Jâ`Ó/u›–¸¸‘„dåæ~ÿ\0Jt©9ÉÎoF[|P‚»!Ž+Í{Pgv\'Ÿ™û öÿ\0\nÒÔníô»u´¶ÁžžçÞ‹­NÞÂßìzi4½yõ§Þ°cuIüçO8ç8œïë]©_}Œ”$¶ÜÖÒt§¼?k»>]¾s–8ßÿ\0Ö­MWT·Óí¼«B+\r§!G­swww7å~Ñ&UxT\n\0_ E–\\Ò“êÎšW7Ë_@´°¹¾\r¨Ü$r¯ÝŽ^7¹$ñ]&»©EaÙ­$Y.œrÊr#ã\\CÆ¬9-LÔ–³›9ÒU@Å+êÏZÊW–·=%…§ÊÕ¼ÎšãÁÓi¾\rºÖ/ã\"â`¢nª˜ûšëüCá[U\'%‰Á®MsÚ.¼M¡6\'yÛ†µ¸ ò:±Rèú„‰¡A¢¤ÉwÎíŒ.xï\\î¤Ü>÷:)`f­$´î‹úÍÌšÌË£i®LdæânÀwüý=k ¶K?ij‹Â àwvÿ\0\ZÍI,´+0‘\0	è:³ŸZÆšöãRº†ãÑPv®yÉËC¶tôè%äóêw¦y²Xðª?„z\nì|;¦G¥Û›«‚w^Iþô¬›Xì¿Ò\' ¸ç¢ÕMK\\{¿Ý£m€ûëÞ³qmÕ‹ª½”4Rþ¹«¾¥0	ÑŸ”xúšÒðæ–!+}p>oùd§·ûU¥Øä­ÅÀùzªþæµ/µ˜í#Æà\\ô\\Ð ìgYZÂŽÝMÍKVK+s#XýÅÏSþÅ*M¨ÞÍ¹ÜåØöª²ßI¨\\…ßºF<ð*_øH4!Zr%˜}ñÎO¦z~´áM·°Q§,4~ó:È\Z+Ke‚µTuõ>µÆxŸZ,aÇ“äçï\ZÉÔ¼q%Ôm\r¾È#ngsü«›{ø\\î‘ÙÏ¾k¦47N/šRWõ:ïøªËÃïsq$2\\\\:…Œ ž¤ô:f²m¼A©Û=É³smö‡.ÍÃœðÝ«ûFÝ>ìyü)­«ñòÇZÆ‹M´ˆæÂ©9ÊWf­åÍÆ ûï%’i;¼ŽI?‰ª²Ä‚&Pª8ì+5µYO1øÔj3ž„\nÑS›ÜSÌ0ÑV_‘7”‡?(§yÓDÞåaTœôôªj|ç4¿jsØ\ZÛ’G“*ôŸBç™—_2=Ê pH®ÚÏÅšsÆ±0{||ËÇé^znÛ¸£íYíš>e©œjÓ‹mN·¨%ýæcpñ Ú¸=}MR³ƒíWðÅÆùúOéXbëØçÚ¬ÙêòÙ\\	cÁ8Æd\Zj-#\Z’Rw¹éE±ÜVˆîvÙ¤@ýöÉÃüŠ­aâëYcº¶)’u|ïƒQxÌ¢ËfÉŒ4g[ƒÈæª09jÕåÒÆn¼×UátÛe,§«¾Ðþ½qÆ?úõé>*þˆ•\\‡nÞõr†‡<jÙì]ŒW?©Þ¯ö›+0@œWj÷Wç(;<Gt:}Þœ¬ËúÇ‘ìþX.|{\"²¾éÀ8õ]¤W¥#*@¬Ä(’{W|.¹i<¬@·Ç.ñ¢ÿ\0…`|H}KLÕ’Ûûvæò	¢ˆ¤“&?bã\\”§ìj5ýnj©{g½¿áaÕ|uáý%XK~“H¿òÎœþ}?Zó/|WŸP…í´ÛXà„ä—çrÇNƒõ¯/–{†%«>GvÎâs[ÊRª¬ö:©Ð¥IóZì»uw%ÃnšRÇÜôªO$`râ«1&¢oz¸Á$\\«öE³sõ?AQ5êãåSU›¥4)ÎMZ‚2–\"§AÆvbI­7í¶ãñ£„õzíÉõÌ1Óõ¦‰Á\r ‹qÂ‚I¦íìŒÛ•ì8ÎP:<ïALÛM¦\Zõ%ó}©<ßjf\r4Qþo?Z)¸¢j{æ§fl\'–Œ}ÝØÅr7é\nÓH~XØ¹Ï;jê:ÄÒ¹|ÁÃè}År:õÑx’=ßxä×ÍaéIÎÌû*Õ=ÏsžÔowJÒ¶;Ò²ÚI7<õ¥¼--É â…‹Å}8¨«#ã«ÎUfÙÐi%ÚÔ«6HåAô­·h2Ê#QŸ˜‘ÅsM$\'1¹SŒdR3—bY‰>¤×<¨·+Üìö°äI­Nª×Ä6Údn°’F$n§¦3þ}ª…ß‰¯\'VXs»ï>ì¹úšÃÈ¤$SŽœ]í©3ÄNIFú\"Pd•¾gcë“R˜Æ0ŠdeT}áùÔ¡”÷mö6¥¨êX‡P¼Di91WtýBÊØ4²@òÜuÞH?þ¯Ö²‰Ú‡•ìáØïôBn/5;{K¤Ž9`?Úôü*]S°Ñî±¦©¸tq¹—€{·LW’²g’20Hô«V_`gh•pøÝÏZå–¿hôì‚T¶ö‰ê¾\"ø™y=³$Ó­»¾L–bÝOè+ÎîµÙu ÑÇ\"An:‚ØÈ÷î~‚²õË‡¾XZ$o—;”œõÅYðöŽ×¶òÍ=›ÊÂ.Òr9à~º§N»g+HK“–ÃÝ³±©à¿ÊŸ—Søâ«Ýê··£l²íþy§ùUýcFE	„%.ùág!Êž‡Œv¥Óü:ðÛKu¬+G\0\róg>Ù«æ§½Æ¹¯eaàûÒãÍi^évr¨þÌšâG$|²ÏZÄR#ÞÅ\'‘Ÿ˜EËãÛŠn¬6l¥ÿ\0+*F™lž•dWEeá­êe†MBâÐ¸Îë‚\0†9ý*\rCÂQéúÌK«Z^E\'--«’{ñþ5Œ«SrµÎÊ;G—VcŒÒ®Lð®—\"˜5Û«KÄl4er0yR0QŽõZAm!’]BHm·`\r¦zãµC­N.×=\Znu#uÄÄØAÈàŠÐ¶Ô0—\ndOïÿ\0\ZÝÔ|!¡éº!Ô?á.¶»s–Öã2ôã9Ï®@ú×3\r¸½Žî\Z4v\0K9Ú£>¸Î;Æjïbhâýœ¯Næôf9—|2äc±ä~¡§^ýŽ2¸’y“\0ŸÆ«Iá(­íÔ\\Ü¨ÀØx\'ëŽ•Ðè¾\0šó@»¾»½¼¶žP¨J¸_þ·?ssÁjÎúØÚn	WƒWêŽkÅZ”ße·û=Ã•,wì$zu¬\r.úy5k4’y\n™Ð\\ãï\nëL¶Xó=ó±ÎÇÿ\0cM·‹GÓošêÝ!w…ó¡/´úÀÍi]4¶¹åb0Í¿ÝMÛÏþÕ$ŠÝX“^wâ—Äþð`÷þ]mÆ‰¨5ÊªÐŒùQ§P8à“RÍ¦éæå>Õb.á·qÁ#‚zãšÓëpvåG2ÁÕZÉÜót½’Ù÷Z¼ˆà¿¡Áü*£cók×¬ßO±YRßCÓvÈp|èüÎqÐg·^ýºšæn|7i{rgP°	XŸ*}†sÇNôSÄ9MÅÆË¹¢£Qék.1Gá]F¡á°ÙOsö²þQ_/ÉÇ\\ûÖ ³ÏñWO:!Ò‘HR‘W^Çb/ÀéO\ZLÏ€\nî#¥\nH‰EÇFfÇ4*‡;qÉ­6Ñæ]¹’0[ É®®Çá½ØÓSQšêÐÃs\Z63W,#°aõ53ÄR§ngk˜J<ËCÏH4Ítš§…[KŽ6’ò6H%Tü¸¬‡´…NÆï¢š¨ÕŒ•â9Qpve\")…yàâºƒ¦øm#çTäÙÀT#æüW¥eá”S¶æîCŽ>¿÷Í\nª}Ü\'GÍ}ç/œñÒŒVýÌ~XX@fi@à“ÆJÃ%?¾£ñ«Næ3J=n1U‰â¯CÅÒ,m6åŒªäœé€qU\0çŽµ©£_®<²ÉH»0vöæ›ºDFÒv{ÿ\0e^¿Ü¶—îšÞÑ.5Ý66&X˜îUn1žù¤_Å\Z®-$À9?7Z™üba@‚Á”‘ƒ–Ê³”êt4öuÔ¿q®kðÚ´ÒiñCà¹lãðÍs³ïÔ.šâæ@%¼Ã½^Õ<_5îœÖßc	àdÉž‡=1X¿ohâ3œmÏ5«#NJÙ\\õß…i–×ÑI6ø®hã¡ÇçœWC¨øÃºJOì;mCSÆgEpßs`å½qŸ|W˜èzÛiþ’îwm©þË2=Àæ“LñÎ›4öt•díœø×=*u§\'­ž†XŸf¹ytº;3âûIÎÙ|c$\'ª¬8 }vÔ\Z–›àÿ\0iK¢é‘ÚêüÒ@ìUÂú€gÓñÅe[|C½‚9¡[`%M­¸–ü«—U”^½û0YÃyƒhÀ\'ÓèzVò¥9Ãk3ÕJJÌ]CÂöË¦@ÖÉ\'ÚY€Ÿ#¡Î+\\D¼ÆàýA®³Y×Qì¤¼Ó¤\nd½8Éà×3.¿«Îd•*Kf =Æ1Yà¹¥Nón÷;±Rq¢•¬WÓ¼4÷×\r³ùAW9(Z´dð;(Ü·ÊW >_ÿ\0^±T½%‰•ÑòË‘Öœ÷zÑc¹½(±[N9½ÙhE:´¹lávi?ƒ&Mßéhpz5xRE8ûd_ð!Š®eÖ’dIZ÷xåÒInÁÏ±TLuf³O8_î™°>œšj-äÐ`¯w`Úuç”ì…Ý‘Àæ¤×4ì{ä·ù‚H#˜1è†jH,¤’v’òV)·Œ¶síšŽæ[­RàÜ\\:¹THÇl*¨\0~@VêZ²‹u,•ŒÀ„œqO†Ñ®\'HÃ¢–8Ë[HHbNM“Ì‘‡˜ñN÷%¦·/\'†Æå_B3éƒÔT§ÃÖ.dÔÑ?soõ5\ZI\"•gg=²zÑ=ÂÂªˆ«¸uÅfã/æ7H-\\Kñéz;\'Íw\"ŸöŠÑXí,’œñEO³—ó\Z{xÿ\0\"7W[»˜ÿ\0¤DKz… ÕmFs1RT¯«²MæØÇò5›tÆ@¬MaJ+šéXîÄÕn›‹w1¤‚C)9À\'µFØF+ÔÖ˜\\¹¬¹¿×¿ûÆ»¢îx5.¥‹hÖIUZEE#$ž‚·#°Ó$hÝ4ß/(øP	¬B½{ŒÕÛ	\Zî8ÅeU6®™¾IM)-Oo…\Z=µ„7×l_‘Y?ž>”×øI¥\0j·;ÎÝ‹ŸÏÿ\0­Xpx¾öóì¶bL©`¤ûdü«Ñ…Ùkhù?p*òyñQ~ôf4pîZœŸ­¡µÉ¨LwHU@@20OçÅs:×…×D¸&¹fŒK;I#Ÿ~\rwÿ\0e+á;eÜFn‘þëWœ=ÍÍËi^_)€íª;jèÃJ´Ó”¥¡Œ¡An¬f Y€{†O$@úU†·°Á+)¹„ÓRæ9®–#äà“Í%ëFUÒ¨3Œzõ®Ý[³9§Fpiëçþb,ÀÈ¾r?ë‘Ö§ŽÎ\07}¢~œ_Ö³b²guHòÇçù×¤kž‹Hû$2áÌ¶±¾b“ yk*õ•&•÷+EÖ½ÕŸO3ŒÒ£K™Ù./…¼A€ËëÉæ»ßi¶wºµÍ²ë·0ùQ¬ËåµùÃ:áõý+Î¦´’Öi`—\nñ“ŸCÜõ«š^§q¥ÎÓÛ9I6gØ‘þº2«IªoW±«Ô„¹$Ú=3Å:n“ex·R»ÝÉÂ2Aÿ\0tòk[¼Yü>^!„laA÷®j}bkÙ\nÏ>^BÌqZwˆÑxj$cÈ žsüUçSÂÎ”`ªJîç§\n”ä¥ËÛro\r^]YEpÂÈÊ²àæ\0ÿ\0^µ¦Ô¯§da§E…<þü{ÿ\0³ïX¶7>]„8Çß;‰íZCR·´O3~ìÔw§V›’Ž¦ÒN\Z)hgêzMýýÄwk)X@äô9Ï\n=i¶Ú6£g:\\7–Wk®xjÒÿ\0„†ÎòÈ-±mÈryÁÇ|Sdñ¬Ÿ`x¡†8ÐÆÏa™¹ÎNO&º(¹?vz#:ô³ö”õoÌŠßP¾¼ÔùÚb«Ê’¸Q´¹«¾#Óu%Ñ<Ëë«P0$ªrN:O\\g·j©¤ÝC™jŽòî;€~cùöçŽ¤cŒ–xƒÅ-:Í¤›;AÏ‰xs¹$úŽÕ¤à]0ÊQ£ïèŒ-&¢XÉ…CÁ#üú×M=¸{FuÆÜ\\l—‘˜çÚ3Œþ¢¯¤‘e‰ÕBóŠÖ¤]Ìaˆå÷Që¾ñ…4Í\ZÍ®…°Ô5ß²ôãºx†ÊËÁRêÖ‘	 šEFÆ~lg¿¥|ÿ\0ge>«}¥ªn–F\nª+×üaik¥|2ƒK†â)…¡D›Êpy’X{rOÁ:*/{ß¡IÔŒ®ïsÌ­ŸTÕ!’[u\rrª¥€ õô÷¡lÞ dÕ\"»Ž0Ø-‘ž½8úÖŸ„P¶Ÿ>1<ÿ\0è\"º˜4¸¤Ô¬„êxÁ\\qÖ»eJœ ÚGTkËvô1SG¿’Î+¡ª_ù2ãíyç¿_‹ÃòO²ý·Pan@wiH¦u2jVÑéðºL® ÙB„\0ô=¸éøV–‹¬ÛÞ;¥”ÑOvÄÈU[ óÉ$Ž¿Ê¼ØÔrvWß±­LRPæåüNþ×³:’ð@]£WyÛ’?ã¶il<öÅ|Ì¥óóyÎ}ýk¾ºñ„×>e…žŸ–Q°”s•öÁ^*õ¥Å…Ž‹ûmÉ+Í\Z@Î2zàÏZëå»÷%±‚Ì¥>h$ÛÓÐàGÃÛ9,ËÉ+`2Ç¯sÍW´ø\\>Ý6¢€8æ\0p1Ÿ_Â½\0ëWv~_I\ny¯\n7”ïÙˆÈö ôí\\¶ƒâ7ñ&¯4\\±›`_-æ!TgæÀî8•ºní•EZÑ“Ñ%èOãß\réþ‚ãJÒ`€ý¢6’TNU:œŸNœ~æ7q\rÅcÁ«\Zú\Zkk…µ×Ûâ•	—åSÆ90lÂ¼›TðUüW3G¦Å%í¨ÎÌü’èAÆ~¼}+Ð‚•Wî£Î…UÉfþg\r§Ê$Ü0Ã¯­XþÝ¹›ìz:;*[Ü+$™èsÿ\0×5§†µ‚Âö²¡Æm,ß¥RmêÚhŠ[IæÄ‹,¸ùòxö­+`Z‚•Hú\n8ìÆx˜O$V±–;‘œ9ÀÉâ¸8OsóÀô5ë Ðïítáup›xûÀžG ¯+Óá?lÔ²ýîv÷Újh«FÖ±«*™±—Io<L’,±³Gî°<ƒú×E£hš–«cÐI\nÆ\n$bžµÅ º½¿vš\'ÚîåÃpÇ‰ÜþµÑè·–š^ƒaÒyW%‰XÉûÊIçþµŽ&¤¢­­ÍèÁnÙçmÓ8#æVÁ8úÕ2I`Û•À­;«[‘,Ògäv,qßšÍ‘Ý[åÀéÚ»\"îŽ\Z‰¦Ñj)P˜±‰w|ù9ÐŽ8ô9\'ü:9t‹½\'J³ºº‡ßC¼G+¸à×4ŒW2qŸþ½urÜ5öƒ¦,×ÑUÑbÓkgœ‘†üiTWEáä“³2nl£‚b¶ì“”#œ+½µ[µÒ/®íÛZÉ°¹¤ò+znéÒ¦ºÕm HöC;»|Ç;8¼Ïµ#kþRn®Ñ³î;@O­cï8êvÓ•52h´È¤€#¢‘r?zøù³Œúø«–º^—)ö£nï¸9lãœãéÇ5œ5+wbì@Ï$±ý½WÔ5‘$\"802~n9³Œdz5+ÐŠÒÛÓé¡´9M¤ÑÌ±Kæ!‹º‚GNÕ‚¦ÇÎI÷í]—†%{­)n$}ÒJO˜zôãúV®­à;kÂ·:{€%;gÖˆUp¨àÏ*½8Ô‚œO?]Šq#•Ç ÍKzÖðYn^daGzß>Öì7ÄÚÞ1þ\nkiú?…õ[a®­Åä®ÝÐ’zôéÅo*Ê+Es–4w{âÅáðß–ãÙvœ\ZÊŽÒtŠÿ\0G-¸ŒÇ½wFM?Wy†ž$UÁýÜänÁž+•¶Ôã¹°hv°•-Î8ûÀyÏ–\ZòÚêtb¦£%#Ö_?Ì‚YXÛ¹=\0çÖ»K=N;i™k,Áa²E¼Ïü+óV{‰ßn32±ÇûÕÑ¾«§ÅÄ¦áN\Z#Ú9<îÝÏíþ5Ñ4Ú2Ã×T›º½Í½NÚY¬ä[iHÉÞ²TàŒþ´­©i©ÿ\0Ä¥ÖXâ1¤€òIlïÆy=½1X·\ZÔa‚£oR>WTûÞÆ \Z¹9\"\'\'œ®:}=k5	t:~¹±_‰£wn ¶3ÉDÆœMsÖL0N0O5¿©jiw£­´äFË–BàŒý+&ÂÔI\0n–RÄ²*ðèŒ9cï±s•nh­ne_nûiHÁŒä3MhfHÒIHù†T×œV½ý˜·œáJöÉ9«Vz|@¬¡\0Œ-Ó¯ÜšÖ.ëB1/ÙJò2´ÍUÖïÅ¶Ÿk,òžvÆ3­Y¹ð–£m3EsÅ\"¶ÂOÞôú×G ßÿ\0`jRf]¬JväÇ çŽ¸«×ºµÕÌ‘Gu&éÞO8¿÷‰k“*ÐÖ+C³[7É5wcˆ¼ðõþŸ\"¥Å´‘]ËæFWpõWI®jW7—vëq<³ \n›ŽH>´TB¬ÜSglhÑ’ºG+5ãý’tv“Ìû£ÛïQ -m9éZ0K\Z[y5däT:£.øãDÙ€dƒ]	®‡Ÿ­îÙ@³žqÍeN?|ÿ\0ïç[10Äð+\\4„ú“[Cs’®ÈÙ‚Ö)maW¸Ï^™«cHYFØüÌ’8›Ã@Ð‡Â à×N÷BÛ@Šw]ŒxÂÿ\0ú¿sÉIjwRP›QêdÚÇ-ê=¹‚EÈ\\¿ýòJõTÿ\0Qä|£ùW”Û·)(P\\É®ÇUñ„Z}À·ŽáîlñÈÏÍSß•JT=Œ7Òä¿%Ý Y&å¸8ÿ\0€Ÿñ®;G³k…»FÍ„ùŽ8·|yv.,t±ÈÅÀöÀÿ\0\ZæR\ZHåxÁ<ß¦/egÝž^)ûöô2ÀXõTÁÁnjÛÚ±Ä‹µ³É]¼šŸûêK‚ŒCµX÷5m£6(XäžXˆ,ÜÏ÷}Oá]2wøLéY­{š¾‡L¶‰¤¾³‚i‚¨‘AÚZénuí\"ww¾uVŠŽÇ@\0ãŠ[wÑüGö{û F)v…`6€Tõ¯5çúÜ‘E8·Ê„Æ@ë^CÂºÕ¿ytÏ]ã)Ò¥zi]hjêRiZä“O<¦GÂ£Ú\0ü;Uk=M¹²FŸV[kŒ°hÝAÀ¸ÅgZiˆ,’êRÅŽ=€íZvÚ0vå½}Ez”é*q²‘åVÄº²¿*LH´KW»[1¸Üp»Žæ¯ëñ,:HT\0¨ñ©ôD†Þäˆ¢ÚA#=Ò¢ñï,Ä`òXb¹jIÊ¢¿CºŠµ6—b¬	»@¶ óæ¾}ºT2É–Î)|®\nàãªÿ\0ŸÄÐRq¦C\rºïdbX/\'š„ùÐ\"3Ã*î )÷›ÓùÔÅktoRWJ/±&“¢ÜÚÝ¦¥nê°/*d“ôî*ôïq)I„—ä*Äp*ì´ÕšÚÆ ÎÂ\0p¸}+Ä–1iÖgPK\"bœíR\0©À#¦*ëÂNI‘ƒÄÆœ\Z]¥Ú›½<GÄ‘2ã-·yÉãž;z×%¨ÊdÕ®œÿ\0¬2k{Kñ^›eQÜ\\Ý«!?ê`WÉî]{b´|ÏkZ^ªl¥ü0I2µÔ(‚PNÐ¹!¾§ðª§	Âm´V\'B½8Æ2³K±Â‹‡‹ÎÚáD‘”n:OÒ½HÐôíKC·{‹Hˆûàaºãšñiy#5ëÚW‹ôm\'L¶µº¹\"bUT¶ÞkªqÚÇ‘	n[ÖôHðüåSì¾aT&Kƒ‘Ðò\nãSZ†ãGº†ã}Û«­Á›8€®<óÞº¯ˆ3}§ÂÖ³[8xä¸B¬:•±^rÖ—L<ë¨%°\nîR+.HËYFsŽÇWàÛäŠÑá+–ß¿ž˜ÀÒº6ñ ‡V±_³30™X.ü†ûW\r [Ýý’â{URçYˆÀçü«út:•ÇŠô¸\'1y¯:…9ù~ðëƒXÕwæW7Œ•’g¦ê÷×7Ò>Ÿmk<®UÕ¤;HúãÛÚ±a²šÂé¬¹†êi€[gjð{yö­ëß\0k×mÍhÍu“û¶eÚIÏÏ~k!¼?uáG‚ïQ¼´‰#m£íO\\;ý+ÍŠpŠM?¹´kPR\\¶Ûçs¢Ô\'¶ÑïUíå<òn!”‚2z{õ®»Ï†\rÝ¶Fÿ\0¸\\‚që^qs§jz²Újšhµš[~ègÞØþ”kÿ\0í´øÒÆÿ\0FòîµC‰\0ìäc§©í]xWË»<ì]5(ÅSÖÛê}bS/Áû8Óæ&ÎíôIýyÇ€ït}?Æ¶wZ„1ÄÄ¡aÉé“Œœw®“H¿:Ž…o\ZË¾ÔB±*î;p)Èéž+Êõ!U¹ò@²°\\tÆk¦”ZNRÙ•Nƒ•éAë×æ{wŽµ»yõ·ºa»«…TBãÔœu5Ñ|;µÙ^Ï´Ë$D¶ÑÄW†xm,µ36›}c*þéÉÁSí\\ö©i6¨IfêáÐñ“€Gc]XWËÌÚÜœm©Åè±]!¶ÑÛ“^cã\nïMx/,n-Í¥Î¥ùS)ÊJÙéá$’{×ÛÌfmŒdÝìjÝ½ËXÝÅ:³·€ÇÓšér‰çF‹Zž‹ãyuh¬,þÓ¨¤és\'1ÇÀ¼ùÉë\\>— O‹]ÊT(\0?$=ïQê¾\'¾Õ-!…€98Àÿ\0´_Ûh¶Î\\eÇ\0û8ü+:²†œ§L#m,	330Ý€§ëÇµ¦xvKOûMô-–íå!I7t>Ý¹®|DiRê1È¾RHdðK2o})ÞÖu)µ¶7¬o÷ÑOËŸ¡Î?\nóëBSîÞ§Lf’÷„»´Kxå[µ™Á$*[®æ#ÔöÄ\\\"	¢¸Vc€ÇœW·ÃoiµŽµÇøÛO¶M;ÌŠ%y€ñú×\\=Ä‘Ã\'í.Î‘µcXðsÔÓšF’Î,nÂ’Gùü)mæ[[û9dŒ”Ž@Ì3Ž2;Šž;P\Z¼âLrrTnïZI¤‰§&ìgÂÒK9ÉÛÆy=jkAq#<	ÊÜ²ì?X6àK,…°QT÷ÏN)Ä¤1H§E òÜ|Ç°>ƒ“ëRÚeÆZ†Âþ\'>u¬aOS+à/ëY÷×&òãu`:²ôjd9mÅsÈÝÉ­û4Ã\ri`t$þ&žÚ²užˆïüwxbÚ\\\0KH=›ÿ\0¯^“î¶ˆçøùW™xbé?³|˜•4v`«Û5é:4ozööëüJ¹9è1ÍqÍ~õ³®:QI—¬ìç¼—d—=ýÖ¹ˆ^m.5Ô^F˜È\0o›ýY€ôæºí[Ä«¤±Ò(ÃÈË“Ÿjåµ^}^Õmõç0<9î=úÿ\0:§II#(V”e~‡á[©õg¿6“-šeþYÙ¸Ž›ºgŸåXvv[E<²*yMlä99:r:×·x2E³‚êÆ$EW•A-ô<W3â]L‹M™ÚåmeŠRlCm!»€£°Éüô¢•oÞ:LÏœ½ôxäh¦âà‰EéÐÕ¤ÐyO,…]˜–À^ùäSu«HlµÁg\"Ëf.ØBèÙ] ‚0:úT£Rx¡uŠr«ò¶Íÿ\0Ä1ÿ\0ëü+ªoK#\Z~ö¥q$‘å\ZÝùä¸ÇéZ^¿ñž§:há7¾F’$uP=È\"¹ýFêêì €\0SÖ½KÃÖ¿ÙÚD6øýæ>sž¬zÔT©*qºÜÒœUGilhjqÞkzBÛk—PÜº1uhàHÂ;m?s~Øéºœîè7Ç±2y\'#¥njWE-Ûn>SÞ¹=4nÓ$,3–n?*ÆêU‹s{tñTðõW,G_Mr£ã;Xäñ×5½¢h÷±±Kë6ŒC’9ŒüŠÍŽ c=F3Ö¸KÍCÍŒ„@S÷OSQéþ$ÔàW´ÂDñœa¹Cn\\àö5ÓEÛâGaEÕ›P–ç­ŸË5éŠ)€¸óž%o²±;‚î+ÈÀÆsïšÃñF™.Š4çœJƒkÆYã#%\\óÆs×¥sZ7Ä={Cº-G;¹ÊùÊ[ièHÁ$qSMâûFök»»s$ò1bZCµIôSÐV•§Cc—„©J­ï{uyq\rÔñ´#b<1dÛÎMBkÙ®rÇçøW¥Ä ’=ÅQÇDÌËÛ‰,ÐÊ™IäzV[jS”Ác»\',yÍjÜ[5î¡ä¡BdmÁÈÆ=³V%ðäh¬VPvI‚Äc?ýjÚ.1V{œn5*7(ìPµsi#0#Î9ª¥SÔqÅu,´ß$,nzƒŒõ=søW.äùÍž¹«ƒ»lÎ¬RIu6bÑn¯TL…Ý@à.H V½ó½ï‘¬25´+…;OùÅI¥iÚ„ëm47bÚ8có!²W¹à~UB×Ä‰e ŠA,`ã{¶Æzû}+ž<óm=‘èÅÒ¢£+jhˆ ‚@#-èOSYÚž«©Ã|on,ÞÚ\\…G€;ƒÀ®±!°šXî²72çhlàÿ\0:ê-OO¸·v\"Cà¸ïøTrÆ.òÔÞnN‹±ÂÝë×\Z²ZÆ$üøÆì‘×v«Vš¬ËÆÅ¦(ùmÏòž„žžõ”$kw€\0\'f!ÛÂúTÖ	5ÀktÁßÓ#85ÑË­‡—ïTv{ž«câøƒN–4Ñ¤²¸¶Œ8“íŒÊÑ³Æ{WœÜy—ws¹)·<šê¼ðââögûrÍtm¬ñªs‘Z¶ßõMGÎû1†³„ÉjOš@ä†ÇÓó¨sR“Q*œ•5i$6Ì°É¸(’ãv\0½;V~¯‘ks´’™œ>ï4ô$òO§\\Ö¾¿îŒÁ\0Ådeg02)ì;æ¦7äŒ*¥”n¹ž†ˆÂjWfõ«P©ÁZÌu´!¬m×Tó\"‚Sæ+lûÊ:`uãó­h§·K%±‘&†<ÛÈ=Ôó~k™g¹`×´œasÎ§°¨¢­&ó •â$`•8ãÒ¶ö*Ç·|×/&¨ö·ÈèÊT“œ{ŒVMãÍªkReßÊ°püš–êté/£Æ#qæ)8È<d{æ™cÇ4¬¬vÈ¼_zÅÁA¶uÆ·´Š‡Dtú:ÛÅ§K1”†ˆnu^~Q×úÕ-~IdK;«RZ4;ÄXÉSÆãþõZÎ	-#yc—å~Kg öÅiXG$÷hûeÉ*¬±¸8Î1Ú¸ù9\'Í¹ß*ÞÕ$´z&›~g±…±ómKÅòù¾rÀË) a‚?=¿•sQÏ«Ü_Konæ4\rŽ¡qýk&ôMpæÈM¼¼„HU³œõë­ûÉüŠš“lÅ°¶KË‘9LŽæ¯_Ú>“~öŽ®‡b‘»‚C( þ ÖîŸ¢Ec«Ø:áŸk«€C\rtþ4Ò†¯¢¬ðÛ‰/ eXñÁÚO vô?þºÒU5O¡ËJ‹åvø5…‘Ê2Ç¸­xt¸Þi%¸RÀ€UKcwHÓžÕfŠhü«æÂ„ÈcŒvúÓšÝœ1¯×ü)I¾ƒ¦¢Ÿ¼ŽÂA¤/ƒìô‹»ÈÄÊ¢O/Îà°Î~¢¼þök‹gX¥Œ¼cî°|©÷R8­¹,ÖòUKŸ™äóï¨í_Æªjð^C¦ØY´*ìIDd ïÇŽÝºÖQ¥ïu:¥U{;ÓZ£±ðæŸc¨é².˜RñežQ•lŒ·½jé::Çã&08W\r•pKrsƒþF+Žðïˆ.ü+´’Ó÷³¶[s`®Æ8÷ëVOf¹ñVŸ{,1Ã\r´©òÀ	, ç¹ë×ÐW\Z§QTz]RÏm.}#w×“þ‹\"£÷Ü¹¯øÅ¥ßOâË?ÐÃ{sdã×\0~B»›O‹:eÖåKk§eBpáõ-\\‰5ëRá¯¥XÜ0ÛVjŽq“ß=ú×[Q“S…Î(BP|³Ðç>§ˆ4ï[Åa<3’³Å!Â2’yî1Áü;šÔñ¥„Qx—RK¸â‹)nØù\0UŸjÒ[C.¡hì&<µbƒ\n¹äŒó’—|ñNö%¼¹ÌÒ,“¼‚~f÷?ãG²”¥ÏchÕ„&ÓztØMðëyx‹1´§Ÿ¹‘ŸÒ¼Ä»ÈÙÁfoÌšô[ÙËi÷qLÄ~áÂ…ç¼+‘Ó´ëëfxÅãÊŸ{nÐ»½3Éý*ßDú˜YÆÒ’{™6ñ\\ÚKÒ3y‘8oÖ»O[G©ÝÅ$¨ÁLCkô=yþu’š´ÏÌÝvÆ~a]\r·Šô‹Èb´›Nw`x-‚3Ž£ü+zqçNï”ãsJVÜå±’ÛPI¢8ˆ©\'\'8ªs‚ÑÜí1‚®>ö7}Ö\'ûvã¦{Wscek2n¬¡…ÇÝúÖ7‹ìíÄ)s³÷¥Š–^26ž¾½ª\"äÒ¹s”qGãÔúh®“R³»Ò¯dLFG–„ †Áý\rrþf!ÇûgùWZÞ(Kÿ\0éúI¶!ìŽDÄ÷ù€\0}ô©©}\Z;7fÆÚ3Cá¹lg}ï#¬»>FUÚ×Î·|4¶ki$@ŸûßÞ®:Ø‰gØÎT·;«¤±¸·²¶_>MÂ2p@çJË™ÂZ\n’«wcªGÊîfëØW?âÆÆžãÌ\'*H§i3ç;Ø!ÏëX—÷’kW‰£0NŠŽ¸ç¿JÖrìaNŒ•Ü–†&£¤Nt¨®s ¥úÁÀÿ\0<ÔzYn6JÅ¤P<¼žž¿¥u¢/³À-@m’)Tv1ô™¡ø5æ³kÛ™ä†]ÄF©ŒqÏ­TetÓ1œT$šØ”Ki3•ž8œG<œsë\\Œp]I+4QHêœ¹Q>µ·qey\rÃù‘îH›k°#¯\\×æ¯éO¥®æû§’=s\\ò­(+nwû(Ôi«¤q“+$ÎB…+©ðÎŽmn£nóO¸ÏÝZ§}¤4í4)òÀ.¸¥sŠ\\J63)<|¦ºèVOÞ]VteilÎþßYÒôûùÉamãbMOo«­ô²KiªH$\0à$Œ¬§n1\\†/”\\\rÌƒÜÕ‹%D¹ßl˜Ø2Hôéýj\'9¹÷kI%‡w£ê·Ý<™øÜýáõ­§`rEp–SÊ·‹4YòIÍu1jY y?7øàÒøR¸æ¹¤ÜNŸJ½[mÒyŸÂËÔ\ZæüG«ÜÏ4¾|ìÄü¤ÇŒ¶:;óÖ®ÄãkÎ{W1«>û‰j›·`ÈzŒvýkÒ71½	»[±SVKÛ]:;«É¥’ÉØŒ’ÀžÛ‡j¥iªx~xÖ6ÓÇšÌ|æ·ì.ÌµµôQÏ¦Ì¿¼G9*}‡¥rÚ§†£:‡› ÜGulÀ±Bà4|ô9ë]˜i{-cù8†äùd\"ZéÍ®Çz‘yVÊÁ‚“Á#ÿ\0¯]í¬­‘Ç;†î=ë‚û$ñY)xÙyÏÌ¸5×EpRÉ0@3øW>%¹Íy›Ð´`ßb¦¯t\"·”»`)\'\0Ö†«³¢òrD‡xþµ{VU’Âà;²™\\‚sßž8ú×+\nI½Ù˜o8é]Mò­XGžZ›7“h‹lâ+ydºn8`ª¯zæäcïy•ìw(K©\nëÏÊÜÕ}E/çË(`x<EC«ÌÒÐètÜcwr»Ì²q•íŠé,oô‹ëÌRÃx£;‘øo§¥ræÞ^ñ·â*{dò¦‚MhšZ«Â­H;t5íK0fQ•Î2Ýè¨å—ìè‘¯\\dýMƒƒz£eZÚ1ò]ÁUÃ1éÚµ¬­ïo–†»‰mÀÆÀ:1’:ï\\ÝÀÊ”rÄ‡Î*å‹\\YÀÑÏp ãšÒiM”[¤ôgQÓmœïDžOâm¿ýzãÚ[ýNU´›t„…Â3Üö«Ï¨ÂëÏ\0ž+§Ðm?³´(\'a‰.ÈÜv …éÏÿ\0µY%ìÑÛe^I#n×Y¶´Ðíl,´Y-æ\nÓ<»·prqú\náÞÏL‹SfI‚\"üÛ$q…>ŸçÚ®x¾êFžÞ,¦¸°V$Ÿ ¬F&8Ø*ÜŽ=TS…4•û™UªÔìºJo_÷k,kÔ,c*=3»·ôÍ0Æ&Œ4‘¼±m|§Ž@â¼÷LŠ)õ²©(P–ÜþÝk{ÃZ¤æî?´>UˆõÎ?Â¥ÑW5x—(»õ4õ[Åj^‰¤¸\0–.Fû\0?­\\ð†.d×4÷¸·UŠIÔøÎÜúu­«‰Z X‚AÀ5¡ðÚ!uã½ûFÛxÚN|c\'ñj¹+´Œ¨ÍÆ2‘íQY,hAŽ&ÿ\0€ý*­5.“°\'©ò•¹+@ÈeÏ@2j’ÍzˆÛÛ°¼äølþµµ‘Ëvx×Æ5GÓ,ìˆK12îIÚÈp«Â¼ÎØ4ˆ¥É-Ž¬s]?Æ}RMKÇ±Y6ìÐÇPÙ\0œ±çèÂ¹H.7NËÆ;`T¨Ø%-åg=jÎ¹ýìå7mQÇ­^‘ñATùÜò1;Xð3ÇÖ¬‚å¤VÒÛ]Cs»ÉX·•‡·½;M·°¾’8íã¸V*OÏ:ü¼÷ýß5B’êvPT“è9þ•³¦¼Ze»Ï4»‡“‘]T}¯éŠÂµí¢:i¶6æhá_#ÌùÙ±½ƒeGàù­\r*òìÀÖ1ˆ“\n|¶’ Á<ŽHëúóí‚°[ÌˆŠªïxbRq“…È8É=k$j×štþm³ÙFr?t¬gÏ¸,[›¡s¦ž*0ÝjO*Î³Ín-år´“ëß5µáýË;aUSÈ(yõëÛó®ZßX¹†áÊÉ¹¤¾ãßZô=Zky)ØçŽ+NK;:Ñ•;õ¸÷ÑÈ‹öœÈ°.ò¡qÓß5’u«•vÃ%ì[ËpW`äãŽ+zêå!µþÏbLÓ~éWûÃ¿?JÐš}#Jvw•ã·‰˜„,dàp*tØtñ6‡¼qšmœrê)}tæÊu2œ‡(xêpn´§L‘îþÏrI|¤ý£iÝ°‚Aü:sœUDñ\rµÔ³ï… Žgß†¶óØã¡É ~†¬Úø‘ô«ë«»¸»–äþò)mJ)ç<Ü~F£Ø»îk,DÑ|ËÑiWM{ÿ\0=U ÄôàTC5†£·ùÝ	á_9çŒŠêôíz5ðê_%³ÆòçlùÚwmëŽ™¬w:’[´ÑÆ$V •ÈãœŽ¾¿×ëWÉ%%¨£QJœ­úœÇ‰oRí¢¸‚,KaÏÞã×é\\ôûÑâí×p)õ#¦x9¶¼Ce¹·1Gœ“œ“éÖ°â2ŽáÃ²È,;fš½Èæ‹JÇKáä’{ˆüÉœ§n$Ç^Çë]‰ROÏí¸€ßhA˜z*az å­p¶:Å¢]È¥ïF!G®ò®º³ÏmÅ­¾àAÄ°iÀƒÿ\0rI«£¬nÕŽlRµK\'tZ†hˆe–9a˜¨Ç\0{V\\Æ×I’Y’1f}ä“ÏåX×\"i5W¶‰¼¹ŽY>P‡òOÛ0Ý	dÓ.n‚»ÿ\0Ë2à©ãöþµ“ö—µÎ¸B”cÌÒfÂêk#Å±YÝÎc“ZRÞÛØD\Zà…i2Çð‹£E\"ÝÜÏ=­Å¼kÌpÍËzãééXš®¤oµ&ÜÅB”c¥ÞvbqäZ-Ê×rùóÉ1ó±™4ØÅ*J8*AÒ@\'§sLûD*ÀSó­­¡Æž·:ý>ú0ìñ•IO\\¾+3Ä—sÌ¨¯òÆ\0w8=k¤:.5§Ÿm(*\0ÆC)#éÅrZ÷ÊjìQ}psYò¸qœe}nt1CÕdÆjÕ£#š©Í+LØò_úV†e%àÁš(c-2fÚ€úŽ\r[ÛRbîì„fÚC‚:WCa†\'{…@n\n±«ú€[÷×Ã`_!³Ï¾GJ×ÁFÂw)2¾YãëYM)#¦“•7næ¼4ëK+†‚(Ü\0«ì\nKíèi|;cmöhn÷¸*Oåxïõ©u\r2ÚæÅŒÉ XášuEFä}£§¨ëý)lµ\r9c†ÒÒÖá.˜²H7˜:Ž3ŒŽj%%% Ò”[MèÍ}LÀÚ|\n²Çæ\'ðn\0àŠ½f}Í£ï\\“G~®Hˆ¯¦W€+KI¸Ô\'ŸË•3¯ðtÏ½Ýå±•jN0µïašå£ÆÆéÚS§Û8?^µÌ¼Å•UWåÙx†ÞgÒ¤ùcæù[×§µrz]¬7Í5²´±:\rÊXœ`ôæ¦¥+Éµ¹Õ…Ä(Æ<û\"k[£n3F]UI+ž¸ªú­Î‰g¤iÓØX´ÊZFÉì§ ‚qÓÐb®M¢:ÆÊ÷*c äŽÆ¸{©ÌËäíŽ0€ßäš(aõnCÌ1ªJ*èt×²O3;:SéÚ‚ÛLD„ìaÀt¬ìÓsÍw¥cÃm½NÚžGG\'\0\0Z×Ó®#†ñf![8\r–ùˆ>ƒ©¬+–X xøùT|Ã¯·i`ûÊª2°î£Ûž8¬gQ%vµ:iÓri\'du¼ÂEº !wƒ»ïÁÍr·QÛo–Bï&â$s½²k¬¸»“F¶šYáž„hÊ\n‚„r9õ¯0¾»ûUÃ2±äí_AXáù«Í»{¦Õ¦¨ÂËvEss5Çß‘öŽ‹“U‘ž6¬ÀƒÁJÎ7`ç4W©Ê–ˆòÜ›Õ–¿¶µ!”nÙÓÒ@ùŒÖÝ¶´$‰#‘XÈTsÆ\rsX‚¬A&]à©à×=X-ÍèÍê»›wòy–rŽq´Õ\r6Ãí:}åÏœŠav±ÆìŽÕ-Ë¹‚A—šƒC»krí€W+¸AàöÍg&ä©$¤±¡ß2)’@í:±åG¹üi’h:ÀQþ¾ªíÓé[0ëVr \rsoÝZ@?­\\nPÉ&AèAâ¹	7tÎåŠIrÊ?‰gáØ¼…kÈ%ŽA÷•XüñYZ¶–Ö×º€llmR2Hõ­ûTE?‰4óJF3©<\n§q¬eßucq\ngþVþF”hM;¹,TZµŽVæ8Æý\r&¡¨6£>mbÂ/@ãEn¢Ò8çR.[®¯Ú/“m%Np\'óª*\ZâFY]€íš°®¦dÎFË™s sÅiwc©n5VµÃ‡+\0ì¾™ë]‡‰<Uo[-=#•bÆ$Ý”Ã~¹®2b²JJ/j…ÆÚ|ªV¸*²¦Úµq­Kª[4WQ–pTÇ°uäóÓÞ­ý‚&TÛo†tÎ£®9ï\\ý‘+)e ‡×#ükÓtzÚm:âk©á3F ¸/$¥\rÛB,å©ÂA§›H[®È¿à^jÆŸ<Zˆs,¹«²“ÈëP^ÞÈoãš7¶I8Æy?ÒªÉš…û¢Hù³Ú¦Òæ»z\Z7gÊ–·ÜôkiWjìj\0ådù[?C\\ÿ\0ü%ú¶ƒ©Kq£^yaèÜ¹÷í‘\\ô–ÐÆ¨È«‚sÇJn|Í=U¹(Ä;\nI«Ü¾V áó;k‹þ2Qµ%‘[‚\Z%éùVŠ|fñip‚{s“º,Ö…|šî÷²_}œ¬¦0¦<Ž\09ÎG­_—áäë3-¾¥ÆDÊÐŒæ©ÊÎÆ	hqú¶»w¬ë²êw›\rÄ’o}£\0žO «û·ªÌ¬\0oº\0¬íoH›FÕšÎgGpe3Žyî*Î€ñ}¡þÓóD„|½ùê~”ù¬®%gdi¬Î#VhËdtÈük8³Ïs°\"ž@bZ·«I º\"Ý°¯ÑPœÓ¡éëøÒZ@bÍ\\]ÕÈ’åv,éäêpd€7ŽO¿¾(Õ­É–ÀF$`¡·î\rœàŒg õïT%]°9#­c¶gyNÜ…\'§ÿ\0®¦ZS»Ø›íQÇôKwa×;ˆþu’´ØL(3œF˜ýO?­H o)@}§ tö¨lðú‚£åÁàŒûR‹W¢ÒÔ‹¹zVÝ‹u]9< ÑJ£æ¦qùb³-£ó§*$	B3\'Cÿ\0×¨žÚDr¥ÁÀ$š¶Ìâ›Ðé´¯ßj¾#´Y5ËñåŽøÉëÅw77‚ko\"æL¬èë¸ô²>¸Áyü‰¯\ZS$r+«2sÁSƒù×c¬xŽv‚Ô¨¼T…D˜ãïÎ9î~§Ú¡ÞúÁÅA©-u ±¢É«ê¡ÀÚÊ±pKJŽòø’çí\Z”Ê “»	þ5½áMeï–^SEJÒ#+nÆæÈ\\dzþ•GWÖ%¼›R²öÁmò\ZIå€ p	ëíÍgÏw£ösåS¶ŒÞ´+o§i°ÈÛXª¸œ*¸ãœžýê?†ÿ\0„~i#,!R™r¯zôãÞ¸;éäñ7Û‰%ir°§BOa^Ÿu·vÂÒE6Bf2w!àãcô9\'‚iNJVuPŒªÆÑ^Gž\\jIuiäK#»¨Î÷by§á}õ›ËU–â…]7,îFåÈÈ\0W…þË42Ìgs$Á]G9Èþx­\"´€ª¹G…š3ƒƒÁàþX?rVÅ§Àôpù4ù¹jJÆ¯Ähšg‡£¸Ò,V+–Pírw)V8ï+‹ðœ!-.Ìé\Z—žb¼à€:÷®‹Ä7R^éio¨^ÈmÞe’^ß“éšã´{æÓâ¹Š™2³7ÌWŒ|§ úÖØ)óCSÎÌðrÃÉ&îvÖ\Z}½ýÄÏ±‰íðª{3Î6‚On¹5ÐÚË-­Œþ}»<°dªÇÒOLzžµæš>±ý‰©´•~Y#,0ëèÏZõK-^ËTÓþÓfÂN0ÀõCèEuò­ÎQò¨²¬Œ`æÂÌãyÈèséíúÀ«TÔ’}\Zê9vïhÎÜþ`’sÍYÔ®ÚÚÎé“9Kp£#$ÉSúƒ÷kÊîõ{™ï¦‘ÝUˆ	žtàv¬ãäu×”yRb 2™J¡•ˆ\0ÿ\0úèÏ–ïb?Ýÿ\0ëÕa<fY22nãšC0(OçCLçMXì|*ÇíWÒÅw#™aQ#•ÇÌÍÎ9çëîkPÔ’[)`Û<r\0=@Î~•­àûuº±¸Ns ÌYÆT†ÇÔšÉñ5„–zÈ’E!eRAÈ÷üªš{²”Õ¬·1o#Xe(™Æþ%A?Î¯ésF–®¦êkmÅ•Þ5ÈaÆr=ÿ\0Éâ„É$BM¬sŒ±éÇ¯¢i÷ëw@òM°	r’¸Áþõ&ÐÔeÔÝðuÔ‘ÜÏj·‚h•\'ÞÀÉéƒÓÿ\0¯^‰i1ò˜»s\\\'†ì¯Ïˆ.æÖo²îÄHª1»ƒø×RÓ<W1ZÛ#ÇÜƒ¯sŠ«û·!E¹ò£JYaq‘Dàƒòzœpxú`×+â{÷Ó4ñ=ŒG!}¾o’pxÆãžõºÏÄi“‚Ç%˜ØÂç\'èzŒšÇÖ­Å÷†gNXÆ†EoB	#Ðã¹ù…fŽ¹ÓV²8ã¨I#¸H®Ÿ®ë‰XþV¹ÔdGm§À{4@†	}c MÖ7LØþ†¨&¸µ‘¶E¤Êdå¦bqôãÚ«SŽ×6ôÍzæ\riï§7°ÂþX–Á¹Á#ë\\T·’ùÍ,3J¹w`×g—™àö\n\nù»œª‚@çQÜWÀ¡ žôâ•îUK¨¤^†úíñç]\\2óŸœ“P›rÄ‘\"ž‡ƒI†r®¦í£½ÿ\0Œ,Ò“¶ÄÅ)-LçŒ¨$²=ê%ëW/É%>lŽÃq8üÅRÁ=*âî®g%gc×¼9¥iï¡ZÍtÈÑCn§õ¹o§è(«1\\\"Œcƒß¯Ozò}ëV¸ò–³GpŒà=²}+ÓtùYG6Õ]ì ±QómQÇ êGzÂ­(É¸Y]YŽñ˜šÕ‚ÙØNa0À˜ü®ß“ÜW/€µERVæÐ°í¹¹ý+¶IT]¬žba‘tceÏ<õã=AQÛÞ©¶x¥yÑd¸d_Ó½k‡µ8ò£,d—1å7ªb@èXAÈl† žjºž8ëV5jW‡ƒ+r>µXõ®³€Rxì*C\02H=\0¥™ŠÅ¹IRr*ËÔ¹ÍDßBàº›mªBaa‰·0ÿ\0ëÒiÓ1Žà!™r9ëÖ³h$òNÓÖŸÑ¶Ë/Þ#Ú¹í¡ÓÙÜ·ô…pg=ãùÓá¾¹´“t77Uâ³\"v`I4èÊ‡Šçæù‰<\Z\\¶+žçm\0Óï[Ìž ²·VÜpOáWE°“¬_øûcéñ¼¬B+Äñïë]WAÆè÷2 C!npx#‘\\S¡&ï4zÐ­_z(®šœyÚ¤gÕ¨¤Õ®.¼g@Ž%pvÆÝ(©öœj¥ö?\0€ )ùNE+F®Û€\nOZÑ3Ú°žüR²fÉR¦½ž	˜ PI/Š_*.ù?hù6G8~LšrØÛ°ÿ\0_ÊÃC,(Cò(\0ð{ÐTŒŒõæ¯Éc‘¶\\þŸa8ÌJå&WWGì9U˜ï\Z/õq¢’0N?™¥’ÞVÀÜ±¦Yó÷Oó¡ê4ì6K‰$c–ÀÆ0)‘1²dãviÍm8ØÄ})6PK~¬ŠæosÕ<m$žC9ûCœìô­9-®Z_—\'iÁÁÞ¼–×XÔl£	ks\n±ÊÀ~YÅhEã-~/»©Hßïª·óŒèFræj4¬KãbOŠnœ²¤`ÿ\0ß\"¹ë	|«õc&Áž õö©õûJòK»©7ÌøÜpp\0>•˜ßxÖñFlëàÃÆõcÖ¥Ý‡ÀW$²HŠ6»®=)ëw8IŸ÷hgcncûÃžÕ”$4èVªòÏ+ýù¹  ïÜôÍD’f”äã±oÏ_²HÏšyöÅ3KD›ZNpœþF.5‡ ÜM6>Ë8™6—Pp>£•Šwh±&ËIÚkyO.Q·Ü`æžò=Óä#\r¼/-ÈíþzVlk#@ÎkBÙfLïÈÀx9¥&8Eô(L’yª_ï?Ì9õ5¹¨Ø¤z,q#&äpîÙëž	ýk2pþRž<Öc¸Z/çšfU,Bp6ƒÁ¨š”¥=ŽŠ2„!>u«ÑÞž8u;Ø{í9ì¼ZÅÕÏüOn¤ àNIÇÖ£³–âÎå®!`ê3Ö›#Oq$²H~iæ=wÿ\0\nˆÒq¬êwC•xË\r\Z]SgIáˆ¬ãñ\r¬ÑcrA“Ï‚•lûäŠí´Ëôÿ\0Kvä½ËöôÂÿ\0Jó>{‹‘s	]Ç äg<ôý+¢Óµæ‚2“Bçg%OrÄÿ\0ZâÅÐ”ÝÖ§­—biÆ*2V;\rRûv—3 £Ä£ê¤7ô©-/R=bå2J\\F“BGÊ@•ÍÉ«Ãp†%mÞ•vÍÝô,“•XÕ(=qÇè+‰Rå¤z3ª¤ù¢mê1Üêúu°u‹ÉrrÉ`ÿ\0¾*çSHµÔ$¹»–Í\'3M#y8MÃq,ãëþ£md\ZûSºûPUV Û2NyÇ?í\n’ÒÈG¦[yR´jÛY{žOëZEû8Ù?ës’Ê¬ýäršÎ‘±³H¬ fœE„•Ÿï× Æ£¸Ž{-fùÄ^d¸ÀÅT\'B=øþ•­®y©-Ê„-È<1ëµ€þuÆuw©º¥åµFžÛÏÄ~uÝ‡”¤“8ñŠ(¾š¯È«5ñ‡Cû9wó¤h\'·¡öéùW-²ÜÝIÍ\"¾ÍŠO|×ZÞ¸¸¼ÿ\0H>K\'*OJä5tò5#ÝÊHîp2Zë…úž]KZã×Nf˜Àöãü}jËiÒ@ûId,Ì„±QÇ8«¨=ÊBþXiF“”`óM¸iRò+€î¯\"±8ÏlœU]îÂ”åÊ˜ë{s\râ=½Ó „•Ióžçèy«Zµÿ\0öœ^uÁß4@Æ¤p=qêk=¦‘Üïrxîi€•I2xÍgw\'¹ÞéÂœ5Wz¡öê>[=4ñqug,~EÌÑ®ýäFÄc¯×Õt,Œ‡ûÉÊ’VbXdã\0c=Í%¥qJq•;3RmBk”½Ò§ž!,x&Važüšu—5+‡iÜï9%ºô#¯ãß=*ƒ hBžO_ ª2Á¹Ž00­V¥ÑœÒ¥%ïDõ›èu´–Ù£t*§\n\n}>¼õÿ\0hç¥`xŸ_:4¦ÎÑ\"˜ºä–;¼¼äSÜúŠæô[¦Òo7ù¥ !‹Œdt8ãô¬‚ÍrÏ$®Îíó31É\'ÜÐ­¹S”•¢÷\'´¸»³xî –eeèPœ~´û›Ç¼ºžæl¼Í‚ÌN1Û?‡µMfXÇ48B†ìj­R?´–b0ŠT}MVvf<—7S¯Ñ7ðÜP¼JÎå°G<}Nk„¼²•o¦T\\©bÊHÆFk¯ðŒ«-Êé÷!ü¶8Éã=ë¨Õ¼+`g°˜œFÓy.GÜ_ü{hükŽ®7ÙTä’:éá¡RšižK\r¬‘Ì¯<`DÝÏlÖ•¥ŽŸ<²)½•=JpG¶\r_×íc´–k;p]Vb=Àâµ4/\0ßë:J_Ç4Q$›¶®Üž?¥k,L!MT¨ì™‹Ã·QÂ7s¡Iu½µäeÃ3œ`=ùæž<~Ì\\Ø’FÖŸð§Eá¹~Ý¨Û»?™fÍ½£Fn Ÿ”:ÕKkO4£µó™˜‘òÿ\0Ç€ý+¦5\"ôG$èÍjÆÛE%Œó¬s$›ÄI\0ƒ×<W©Ú†ÊÅ	°1=P\0ïëŸ^+Ëä†[mD[4Iò¹U9»«MAm\ZÚÞæáR$Œùlã…î@úÿ\0:S7ÃË•Ùš7úœzd÷—(]ÌÜ6}8ã9÷¸]GU{ÍQ§I&1á]‰â²umB]CT•¼ù\Z\0çËÄ€3Zºl){g$D|ëÐÒÛqÔšìeLUerc\'šdR/š¬èAÉ#?•,–ˆ/\Zå1æ?¥Bm¦V!8ñ¶ºM\'\rM‹JÁ¬¦‰4ˆUÙ¼±üŠçÖç\0¶ˆãÛNOSÏ2#¶84¶öM,L¡dõ5©åÂŒÞÈ…¶K(PGLT‚@ëïZe0òˆÛ‰åôªÆ9¨©ROb9-ÑP:ž>µgÎO±¬AùOO¥4BX“Œãß½4ÂáÀÚ9ªº%)#°ðÔ±]]q±ÙT0!sŽíÔ}k^¤P¹S¼}ÒØ8ç‘ù×#áÍV-\ZöAq†)@ñýà=0x ÷­iµÈm5É–\'ç÷c€ãŒu¬ÚÔí¥UrÙîj\\íÚFÒ?yŸºýÔ{Ñ\\ýï‰RFÂÀWÙÏ´QÊW·ŠÒæ*Ÿ¥&{`ÆŸÔt¡cç‘Vyã3ìE;§ñOò¹\"”Bvô ,4HË÷_£Ì~¹ÏãRrOJwÙ\0ˆwÉÔÒ¬’õÁØ©DvéGÎ¼ÿ\0õéÈo›ê)’ÈY\0ÏÒœeqü þfs’1EŒÏ\0Ò÷À -Í1\r?wÞªž¦­Öªœæš&?vš§ ýi_¥1>ñªæ«†Õò¡ˆ¨`3ØÕ6Ö•ÝâÏJ©‡Ew~ŸÊ“‘5­Á\\\01õ¦}ŽàõlE4«ÑÍL·“¯ñiì‰b¹_•#p}–šé9o›~}Å^ŽýÑ²P{àõ©ãÔÐH¢\'X9™•:©ÈîiÅò¸Çé[ÃS´¿=ÊæœeÓ¤\n|¸Àé¸ .Ì4fô©d»šÓh´æ9P£èiŸfµãlÓÖ¥¦i	¤õ+ÅÞù©Õy©Mª„ÌrØà\Z’+9š\"ÍÔvÅc(Iž…,Mîü¤µ¹gr!!£RqÚ±\Zˆ`Tç\"¬CæìÊoaìA®Z”$ú•<nÖR6Tx|?sòþöf‘ˆ‹¶9ü0+a¯ÉTE\ncŽ¸®>o8Æ#Û ä6úÔßÚW(Bs×%\re,4šØQÄÑŒ¾#GU\né)c¶U|cÍSÕµ™%ž¡»6åàhÙä(!\00ÉþAúÕ›éfS¾AžãÒ±ål1&@]˜h¸+~c8Ti£ª¼Õl/&]š•À³½ãÛìpy<ã¦Þ3\\N¢Z]BrŒÒ¡s‡eÁ<Ò­Å(\\är{Ô;—qÚœ“Öºï©ær¤–¥»‰ÕU”)D!~¸›q7úäá2¿ÉªûŽ~éôü)äƒŒöõ¡ê¬:RpŸ2I†ï–I¸óž´¬—©Bãå¨I#z•çQê5Bà|çŠD9Äñ»#>ÕabCÁ«i´{TÜ¤Ø«(*„ôÛýMR¹™<ôd##Ö¬»r\\`ŠgÙã%E\n*÷*U_-ˆì˜Ù]AÈÆTñLŽuNFr*i-ÕÁUÏéIö4f¨5J*Æ2«6Ó¸¿jŽ9|ÅÚAÀÇJd·&ê|àÇµ1Z’ÞÚBÛƒ‚­ü8­(4èüår®íè¤’Ô˜ÊMrš¾¹†ÎôÞcË\n¶í§*G*ÝÕ|Cn,d¶’_*R¡â.ØÃ)Êœuê`Üö“(°fãXÞ\"´®Zï;€1žF+ÏxxÕª¥#»Û:tÚŠ6!‚×UÖ’YdÝo\r<åz±\'¥zG†¯à³Ðl­Á\0,C v\'“üëÂìïg€:¤Œ»À\rè@õ«©^)b·R®ºå•V\'ë.[èˆ¥‹ŒukVuk¾¡â¿A=ãÚÅ$Œ|Õ8ÛŒ·#¸ã¥V°Ñî´»¡=ÖÇŒÃ½\Z6È9=Çc\\ˆžW3–wg‘,O\'ëùÕ«MJêÎÒxQÉ.Gg¸®¨R”l“ÒÇ<ªÆWºÖçq$\Zª–÷eMà²‘åÄ:Ê¬‡‘ô,jØÑl,nÅó^Eùqª¢ºœç¯N‚¼ªÆìZjpLÈÛwaÁn ×[ˆn!¹º	mB@Ê»àûGùâ¥Q”.®Ùn¬enŒ¥à\'KÕu»»}K%Vx•N	`ÃúNÓ¬$†Åõ8Y¼¸ç1H:qŒsœóé\\ó4úv ·\nÈ®³ŠQ¨_¢°ŽYüÂ¨ß.ìç8éØS)¹sEöU‚‡,‘³2FÚÝÄ£nØâw?&§`²/›o\0fhË\r‹þRÖ5;[Ù8Áé×¬Ç4ñh¨ñ»,zzzU5$´dÅÅµt;ÁÏÂâÖDŸx;Ä‘¹\0:VÕ…¤~¡m(m”6XCOÂ¹-\'UK—–Fo¼˜zU»}p‹éff?¼\0=«’µ	ÊRhë¡Z„S{.ìâ‚;”óÚÉ¾2?¸yÿ\0\ZÇµd2NçvúÖ¥Æ¡÷jÈôØëž¢³ähÞÂÕb‡i:I êÜ‚?JÚŒdâÔŒ«N*iÄ|V¡a\\¯$dÔ&kµ\0t\\Õ–”…VV?i‚x\\U+êi\'$F#&lp8«p\"˜“Ò PÉnÊzœ“O·cä¯=¨•Ú6£+³?TP×y\n)o•¼ÍùëÅÑMÚ)uu›e•ŒÞ¤X}ªÈˆžÃ5<pœ`ãð¦dUXO¦*AAž•qa<pµ\"A¸ãgZC*-¾áÐ‘R­§<Õµˆ)å!S\"/=áH\nBÍpxÎ™%ÈX%j¨@94†(äë¸LÓ£›–\"­ŒUw#ÅtÍ¥Û?@Àû\Z«&‹``{SBº9ÇB£ÚGZè[B#¤ÃñUô‰×¡R>´É¹\'5[i$œµ´úlëŸÝ“î*³‘>òíŠ.¹šyïBsÚ•þWlv4‰žAéT!q¹€÷«A@Áª¤à­k­©\'¯jM\"¦ÐGz\\u«ße9íHÖ¿©¹|¥0¿CN]£­[‡nF(û3w•Æ¢W§±\"Ä•7{-9`oJMšFbÄ½3Æœ-ô5 €ŠF}ªŸsxÂtD-ÙGÊ[ð5\"‹¨×i9õ5\'–GQK’9çÔ¹¤_±¢÷B‹‹ÅÀó³õ\"Þ^¨ÈÛô¨³“Éjxuèþ\"Žy	á¨ôcÎ§t “œÊˆufŽ@òG»£Èníša·Ü29Ï¥\\gÜç–ùY¬5Ëy0\Z1ŸR¹§½2dÚÑÂ3Ü­`=©–¨ÚãÔÕ)#QšètŠšTŠ39ÏjC¥i3Í!òÑs¹AûÕÍqÈ\'?Z‘YÃ§rZ7¤Ñ,U‡“»“€3ýjAáë2	ó$×Ò°<é‡*ížÕ*êHGïXÛ¥\Zˆ»&“Ch¸u=Ã\nhÑv²‘2}@ª­ª\\2ÄéŠtZ¬ÉÍ¹¾(°Óf€Ðg(^<vf¢“C¾ì7v=)!×]1º<ó×¥ZÄ1ƒ’’gÐ\Z›\Z{Im£_£ä±Ç\'Š‰ôË¥ûÑH?\nè—Ä°tÚÃëRÚžCàûÕäÎHÙH8Úãð¨M´¼g?JíX³e,ÒÇ×ûµ—–uL;Bœü£ð \\Ç3i˜(ÐÖ‚\\‘Ê©J¸â9D´Dç<qQ¥¼v¸#Êäœw©”n\\jrŒ7D¨ÊÇ#uf]«‚K¸\n=ë£û–8gþVÍGu¥Æ#Ìr¹·z•ë)+xã¼j?(’JàŠé²Ô’¾iœeÒšú6$Ú\'€¹íÒ´HÍÌæ¶Ù ŒTŠÖç“é[gA¹tÉþîêch7€`[ÿ\0²ôÉ¹…,^aíN{y&Ã<Œç$àVœš-ì`Ÿ³ËùÔkqX¥ð>\\Ð;£;ìÞ[c Ô‘ÈÐ«\0ƒýáßÔU ªÀ3)9öÅFÜa*ã¬u{‹C!+obÍž*¾ºA: %ÎAíô¥ÛÏ“oéX¤Ê«\'¯\'Ú­¦™+(`Ê°ÍFUÁÎ>•¥\rüJ¡™8éÖšó&^F;Å\"1Áô¡ÕñœsŽƒ5qæó%,Aæ‘Ö7\0‘‚:RcCœa˜ŠnFï½Š±×ÖÆªs´b¦Æœìƒsr ñDE„{I#Þ§!HÀâ¡u`2håvT»-ò†rG½#À\\‚ÆŠ´ŒÞ¬ÝUã©þy©•ÎGÒ¡W {Ó ò*ErÂÈSªŒtÍL&\0àþ5T>{R‰<µ;Ë‹ \'9Ç×ŠzÈ8\0Î©	9¤É4XF‰+žÇð öÃùU\0O$SÃ•þ*\0¶‰ûÇŽ´ÖÞ:1ôªé#sÎ¤ÜHÎsL	7‘ži…‡¦OÖÉ‘‚¿•4¸ÏÝÅ\08¿ªÎß! ã¥Þ½Á×50by¤9\'\\1M(ÚùœŠè$¶ƒ%‚íc×½@ö¾òäõWˆ¤«ä+VÚý¥eO-³ÜŠ‘m£Q€ ~*E³…8¤ÊDûXþ4\0Ã¯&›¹—¡?•=\\‘Ð\Z’Ðü0)@ÁRoÿ\0dþ»³ØŠFˆSÿ\0ê¥ÝÓò¥qÖ×±-˜ÙáiÀ7÷jE\\äâžT‚:`ûÔ³X‘c\'SÄ`qœÔ˜ãµ<p›4DNzÓL\\ô5k$r&ƒœäŽ)!²—IéúÒyeG\0;Õ³{bšÝq¶­3	FÅ6\rŽ½)2ãƒ‚*ÉLžF=1Lu‚¨ÅÜƒ9l`RàJÉœåH!äšavVm¹èGÒšGûmW4ÃÉ¦Œä™I•ðv¿çJ¾`ÏÝ?Z0’8ëM0ØçÖ¨Ì„–?ÀÒÃ2\Z˜Dêi<®¼àÒ±JL‡Œq‘ô¦	ûØ©Ìlß_zO(ú\nä`\0~÷4ñHÙÝÁéO€s´Rì<`b“¸Õ†ý˜ŽN	r‹òÈGü\nœ\0óÍ.ò$Š›È®XŒ\rxœ‡lzqÔ/aäl{Ò[\'iZ‚I%sž=ª“}IqAÒ^ÜH0Òý8¤kŒ…ÌJ÷vþå7xîµFv7!×Ú8Â˜÷c¾jÔ~\"]£Ì…s^bŸ­©ÜhŽ©<E	êHJ—ûrÑ€ËÊ¸üsÁÍ?ZÇd.m$RC!Ú˜ëk)ÆØÈú\näþÇ»å_º[ó ,tÓXØ”%£EÏp*›éP²ñÚ±ÒîxÏßo¡4á¨N£kÔS2ÛØB²l\nû»Œôª­j‘ÎÑ³°<`j3¨Î¤aÇ×‘ÝºÈeÂ»æËßØÅ†VB£Q>‘:\n·µ9uwÁÝ<zÓ×YÀæ6C@I¥\\À7¸ö¨žÒèPãÚ¬¾¤³Ì¦BÁAëVÆ¥lS°]˜ío2˜Ûß£edÜ~»öÛwE=g€¯Þ\\öæ‹Îi‡Ô~WD‚\0¿9VcÉ4P+™Û½ù§†ã¨FqÒ•È8Á%ž:SÇ©ê*°n:óOß‘ŒÐãžä\\Ó•Al^æ«ëNV9ãùÐ‡ùŽ2:RƒÇÌ*ˆd÷ãÞž8Ô*3P=éÛºƒœ*‹w<Qž:šar]Ùn\0¤,AàqíQ=ZB¥‡EX½)¤ŽœRˆñÁÉÇ­.Þ”L‡µ\0èp>µ0\\ŠB1ÐÐQ—ž¦ƒ=üªló‚iÃ”†VÃ©©7ØX!*:°>µ6Ñž)þcù>W˜â<îÙž3ëHh®\0Ïÿ\0ZœsƒŠŒúÑ·=zJE¡¡p9Á”¡>à?…=cF9Æ)Â1Æ3Pi†…ãÿ\0¯OUÀëƒJîûÇµsRj˜€‘Žÿ\0JRG\\Ò¨aÐRãŽ™¡¢ÔƒvNwsÒœ«éÍF\0ÏÝ?\\S‰\0})X‡c3Å&C.E4cÍ/aúbšD¹ÆON>”›AnzÓ,0	¦õ$Ü÷¦fÚ‚>”Â¬Ç àzTÞXd-ì{Ó7ûÜS!ÚAõ=y¥##Ò”‘Áõ¤nƒqÇÐÓ\"öÐa#¦3î7oQ»éR`ÏjB½8Ïn”É#í’ ïFÖ$‚0EKåƒÖ(É9?•±À¡úRí‡ÞŸåäñÉ¡£\'¯ÒX…È\0b›¹G_Âž#ÛÐ~Žÿ\0J°ÒFqšd›IëÅIÈèA¤$ã•Éì¹\"ŽŒ0j2¤gªÉö`ŠaÆO<ÔÑ,‡nO~TÒ0FsS§¡çôÉ ®“Ëçjr€úƒê)R2£$ç\rŒìÐbãˆ«ÅÜãš~À‘K˜|¦iÎhÚyù¹­÷i†Ý{db„Ðr´Q!³Ú‡îd}*é·VÉúÓ\ZÐ=éÜEºûR€½6â­˜ÎÞÙß-³Ðc”[jÒšTzãÖ¬løx¦˜Ôž˜ö .V8®\n;py©š%ãÎ£1àqœÓ¸†‘ŠC¸t\"‚¬:óHâÄ/ îE)ëÚŠN¬O<ÓÉ÷¦(ãÒ…Cœõ d³šzäŠ`ãÿ\0¯Ru„(\"äS\084ðsšc¼€Š]ÇœSF{ŽhÆOš\0z– c¯­Ilf¢]Ã©§#ÒäÔ.sõÅBãîŸ|\Z“p#ŒS äQŒ68æ›ó1ŒRŒž[ŒRvòIâ›œîçŠ·°£\0žFh€NE!”ow=ªP :}\rRƒž¤pÁ^3“AWôNôˆ¯?•H¬Z‚›8#¡¤E ÷ÿ\0ëSÇ œ~}éY€?J„# ÷©028Å!<p3Nð¤RbíöÏ­&ÍÃ÷\0\Zp\\ƒ’iÀœâ‘W\Z«Ž:RàcŽ1JÃåàþ”Œ@Æ{w4X|ÀqÎ3HG=hf\n:œ{Tfápp~”X\\öáºpi H©A3œýhHÃ}¨°9w?Z	=¹ü)åvœr•#g°úâ™\r‘üÝBŽ˜¦8b:TÌ~\\Œ“Øt¨×Í #ëÍ2.22äíaÏ°§œç¢¤ÎG#Û¥.Sv03@\\P‘×AJ—%yÏ­=0è3ì)xç¿Ö\\f[¦>”6Hà`ZÝ¤€=E.ÖÎ3NÁq :çéH9ÜM+)ÛÈ¦¨(1†Ï¯Z,+Šd€1LÜpsÞ”“×\'â”¾îN¹‹\náŽ94ÜqÒœ]zH~îá´š@4¨n„‚{Ô>_<œŸz±ŒŒ¯Z€–$ŒM\0À˜cžA¤+´öæ¦àŒSX*¯õ¦!™ÇQÍHOSL=Æ*eR>´™HPS‘‘ÚŒpE\0H”rµ¡TpM\'CÈíÅ#ÐŽ=©Œš,;Œ9Ó=©yîAïN$ž¤ïFÉd¡Aæ™ÐqüêÇ8ç­7oQ·ñIŠÅc»8ÇçF[ŽÖ¦h€ã±¦):S]ÔŒ ö©Ž3ŽôÒ\0 EvŒõ	‹µeò¤ár\rD_\'h¼òh©ŠƒŒøŠ(\0Ï\\ÓîáNò[VÍ4ïA÷*H«\n;dõ§‚3Å0n+ÉnÎH€&ÉÏ¯)LXT`äòiw=¨epØÀjx -@-ÝºT«œ\01ùÓ*¯½.Þù4ÀHiáˆpëéHb\0ýiø8ç¿§z\\“Œ\np\rž0iÜ\nÄ—ó§lç­WeÊ¶F=jU%€ÚßQŠ@<:9Å\0äõ‚	\\ç?…\0.à½#È ã»r})ûqëH¤4!9$}iÇÓéÅ8cªš1Ï¾(šë’íŸBGJr3:ç‡­;rAÇÐÐí@Ç®xùqøÔ»8ê¨ÃdÔ™\\uÅõê)1´ýìzMë÷sj\\àÒÀ>ãÖ‡\0°çðÇ¹R1ŒŠ	\\æ€¸1\n\0O¥7\n¿xÏþ1HPÊƒøt wî\0\0¿(¥0=zõ¦@Ï^;ÓLnpÙÚÝÀæÆìŽ:\ZP¨=	ïM Žs‘íJ9ëÀ¦CÏ®)¬‹‘€sÓŠ@ÀžØõ§Ï© BÏCŠ3Å\0àŸÃ4°åpxM1\nÃœ¹ô¤\nß…4¼Ìr}qNI2¤‚\rdÎ2h<1ÏA×š—¿(ßÖ£BÏêž6œÓ>§‡Ç 4™aÁ>Ý*F¨8Å\"‡%„Š\0ö9 LƒOãH#\\äãÛŒSÈ`êüËb—œÝè\"¨ÇnÜc½4Â£<éŠ”ŽrsÏ¥3ËÎ0ÜP%Pä{R` …`®9\0Ÿ¥!b§îñô \nÙ=Ldc¯½&w¯#V88âšÊ®ãŽ=èŠ6ä3Æ¤@0\'ŠsmåsÏlóL1‘ÔÂ¤c˜Ž‚`SpÀžÓ æ€xó:zŠmöœt¦¹ëÏài¦@Ÿ.àH÷¥iÚO®)X¡#ŠByî)¢Aß#ëAe\'“E‚â’3Æ”×SœçÚ“qêGÒ˜®HÇž:RÀèGµDO~”‚ô\0æ¨¦Hç&;~´sŽM1H;¤Àž´ðTœpÒ6~\\Š5#8,âºŽýh .*L­Óš~@ç¯Q0\0c¬!<j‘’\0§ˆcŸjbrÕ2ðF;õ }œòç=é<–ùsøÔÒå™O QhìÑ†lÏZ\0®Ñõôî1ÀçÖ¬³À=*9¨9`3@Æ«|£$“íC‘ÁG¶jYaXˆ+žsÖ‘Tôâ„ÅaÊ¡0:‘ëOÜŽ*<—ÜOcÚ\r ŽÇÖ˜F¥²r=*E#qõ¨A!9ïR+’¹ÀëŠ\0“8#$bž8ã·Ò€ …$w¥SÎ0)\0 Š\0ŒÓ=èA»¦4<m$ãšA’4ÝÅH\0Ô€üøÀÆ3H¡íŸzj¡–°8!8ö¤V$à÷æ€¸ì\0Fzq^1ÀúÐ\"‚2sÏ4cåÏ|Ð´€Oö¥PÄG4åôõ4Ò6±\0œPÀûÒîçž‡4Šp„÷¡¸Æ;Ð)À¶#4Üþ‚£.Âg\0ñŠ\0œr8\'Ž´ zsPî9?^yç½Ü›pÚ	úÒ0AÏ|ÓJ€=:RsÏzb¸»qßáŽrj-Å²Oj\\’Àf‹x?ÞägÒ¤‘QHØÄúÔ-ÁocÅ/U9¦„¡¹#\"ŒqŠp±ÙœÐüµ\0„•0;ôŠH\0úÒ‚Yù WN89ç¦)˜\0ç9ÍÅÔô¤v¨ .H1ŽhãT%›#ñ€3Öˆ\\{P	R}>´æ¸#\"˜X„Èô B\' zúb¾*Oµ<\0\\ä5$ˆªqý(c*ùèF\\=·R’ðsÏµJ\0¼¡”Í\0C´’JL|Øâ¤aòÞ˜ßz4„Ò6å…Cq#G  çžõ9ã§¦i¬lrÈ¦:’1€\Z•ú®(~¤Àc‚(H=*RáQº‚Fy¦\0mØÀÛÚœsŽ§>Õ“O¿4žcpxäÐœpFïzfçƒN\r¼|ÜÒ“ÍhŒÈFr)D€õãè(*by\"›€T7|ÑqÁsž3MdF<õ”¤hÚ0N=è\0QùQI´c½ÿÙ',1,NULL,'italiano','pizas,massas',NULL,'piza,massa,pasta',0,1,'https://www.w3schools.com/php/php_file_upload.asp',9999999,'po',NULL,25,'mesmo pinta',1,25,0,1);
/*!40000 ALTER TABLE `restaurante` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-06 13:53:33
