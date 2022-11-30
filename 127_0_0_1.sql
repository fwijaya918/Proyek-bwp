-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 03:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_proyek`
--
CREATE DATABASE IF NOT EXISTS `db_proyek` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_proyek`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` varchar(5) NOT NULL,
  `nama_category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `nama_category`) VALUES
('C0001', 'Skin Solver Serum'),
('C0002', 'Body Creme & Oil'),
('C0003', 'Moisturizer'),
('C0004', 'Cleansers'),
('C0005', 'Eye Treatment'),
('C0006', 'Toners'),
('C0007', 'Sunscreens'),
('C0008', 'Wash Off Mask'),
('C0009', 'Body & Lip Scrub'),
('C0010', 'Set & Bundles');

-- --------------------------------------------------------

--
-- Table structure for table `d_trans`
--

CREATE TABLE `d_trans` (
  `dt_id` int(11) NOT NULL,
  `dt_ht_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_trans`
--

INSERT INTO `d_trans` (`dt_id`, `dt_ht_id`, `product_id`, `product_qty`) VALUES
(1, 1, 6, 12),
(2, 1, 3, 12),
(3, 1, 6, 12),
(4, 1, 3, 12),
(5, 1, 4, 5),
(6, 12, 1, 1),
(7, 12, 2, 2),
(8, 12, 1, 2),
(9, 0, 5, 1),
(10, 16, 11, 12),
(11, 18, 3, 3),
(12, 21, 1, 1),
(13, 22, 2, 22),
(14, 23, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_trans`
--

CREATE TABLE `h_trans` (
  `ht_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_trans`
--

INSERT INTO `h_trans` (`ht_id`, `user_id`, `total`) VALUES
(1, 1, 4008000),
(2, 1, 4008000),
(3, 1, 4008000),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0),
(9, 1, 0),
(10, 1, 845000),
(11, 0, 0),
(12, 2, 334000),
(13, 1, 148000),
(14, 1, 19000),
(15, 0, 19000),
(16, 2, 1567000),
(17, 0, 19000),
(18, 2, 256000),
(19, 2, 19000),
(20, 2, 19000),
(21, 1, 58000),
(22, 1, 2197000),
(23, 1, 58000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` text NOT NULL,
  `product_category_id` varchar(5) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `description`, `thumbnail`, `product_category_id`, `stok`) VALUES
(1, 'DIAMOND PHYTO Stem Cell Serum', 39000, 'DIAMOND PHYTO Stem Cell Serum&nbsp;SMOOTHENS TEXTURE AND DIAMOND GLOW SKIN&nbsp;Vegan serum with Real Diamond &amp; Swiss Alps Stem Cells or diamond serum to increase skin smoothness &amp; radiance, accelerating skin renewal, while combat signs of premature aging such as wrinkles &amp; large pores. This Somethinc serum is Equipped with 4-MSK Diamond Bright Molecule &amp; Guaiazulene, which helps brighten, smoothens texture, evens ', 'Diamond_Phyto_Stem_Cell_Serum_Slider_0.jpg', 'C0001', 0),
(2, 'Calm Down! Skinpair R-Cover Ampoule', 99000, 'Calm Down! Skinpair R-Cover Ampoule&nbsp;Emergency Soothing Rescue with 55% Green Plants for Skin Purifying &amp; Calming&nbsp;This lightweight Calming Ampoule works like a charm to soothe redness &amp; rebalance mild-irritated skin. Enriched with 55% Green Plants Skin Purifying &amp; Calming that contains:&nbsp;1. Madagascar Centella asiatica (Madecassoside), a powerful natural compound found in Centella Asiatica. An antioxidant &amp; soothing agent that fights free ', 'CalmDownAmpoule-1.jpg', 'C0001', 100),
(3, 'ASAP Eyelash & Brow Treatment Serum', 79000, 'ASAP Eyelash &amp; Brow Treatment Serum&nbsp;PERFECT LASH &amp; BROW IN 15 DAYS!&nbsp;Get thick&nbsp;eyebrows &amp; eyelashes with 4x Active Lash &amp; Brow Growth Stimulator to lengthen, thicken, grow, and prevent hair loss up to 3x in 15 days* with Synergrowth, Biotinoyl Tripeptide-1, Lash Fertilizer and Pea Extract.#GrowASAP&nbsp;QUICK FACTS:(* Experimental results of the active ingredient, Biotinoyl Tripeptide-1)NA18211202333HOW TO USE:Apply to a clean &amp; ', 'ASAP_Eyelash_Brow_Treatment_Serum-Lash_Tracker.jpeg', 'C0005', 100),
(4, 'Granactive Snow Retinoid 2%', 169000, 'Granactive Snow Retinoid 2%&nbsp;Best Choices Retinol For First Time UseBeginner-Friendly Soothing Retinol contains the most gentle &amp; less-irritating retinol derivative, hence Granactive Retinoid is a Fungal-Acne Friendly serum that is suitable for sensitive skin. Granactive Retinoid is clinically proven to reduce wrinkles/fine lines, tighten &amp; improve skin texture as well as preventing signs of premature aging. It is formulated with Snow ', 'Somethinc_Box_no_frame_Granactive.png', 'C0001', 100),
(5, 'Dark Spot Reducer Ampoule', 129000, 'Dark Spot Reducer Ampoule&nbsp;Dark Spot? Acne Scar? No More!&nbsp;PIH &amp; PIE Targeted Treatment Ampoule that is formulated with a combination of the best ingredients &amp; clinically tested active ingredients one of which is Tranexamoyl Dipeptide-23, functions as a double brightening effect without causing skin irritation. It is also able to even out skin tone, brighten up skin, reduce acne scars &amp; ', 'Somethinc_Box_no_frame_Dark_Spot.png', 'C0001', 100),
(6, '1% Pure Retinol + Squalane', 255000, '1% Pure Retinol+Squalane&nbsp;FOR ADVANCED LEVEL RETINOL USER&nbsp;10x Advanced Retinol contains the purest version of Retinol known as the Gold Standard that helps prevent signs of premature aging. It is a potent &amp; stable oil-based Retinol so it is not easily oxidized. Equipped with Squalane which is a Natural Moisturizing Factor (NMF) that maintains skin elasticity. Use it at night &amp; always ', 'Somethinc_Box_no_frame_powerful_retinol.png', 'C0001', 100),
(7, '2% BHA Salicylic Acid Liquid Perfector', 119000, '2% BHA Salicylic Acid Liquid Perfector&nbsp;ACNE TREATMENT SOLUTIONAn effective Salicylic Acid core dose serum that functions to 4x Action Acne Combat &amp; reduce stubborn blackheads, by exfoliating &amp; get rid of clogged pores. Formulated with Maclura Cochinchinensis Leaf Prenylflavonoids which are able to minimize bacteria &amp; reduce excess sebum on skin. This serum is also enhanced with Natural Soother which keeps ', 'Somethinc_Box_no_frame_2%_BHA_Salicylic_Acid_Liquid_Perfector.png', 'C0001', 100),
(8, '3% Astaxanthin + Chlorelina Serum', 89000, '3% Astaxanthin + Chlorelina Serum&nbsp;SOLVE DARK CIRCLE &amp; TIRED LOOKING SKIN!&nbsp;Triple Algae Power Formulation; Astaxanthin, Chlorella &amp; Spirulina are 65x* Antioxidant Booster that can provide energy &amp; freshness to skin that looks tired due to pollution, free radicals, &amp; poor sleep patterns. The combination of the special formula contained is a one-step-solution for busy people who want to reduce the appearance ', 'Somethinc_Box_no_frame_Astaxanthin.png', 'C0001', 100),
(9, '60% Vita Propolis + Bee Venom Glow Serum', 99000, '60% Vita Propolis + Bee Venom Glow Serum&nbsp;BEE GLOW FROM NATURE, FOR ACNE TREATMENT &amp; GLOWING SOLUTIONBee Glow Essence Power combined with natural 60% Vita Propolis &amp; Manuka Honey has long been the main key in treating acne, breakouts, also reducing excess sebum. Enriched with Bee Venom which has anti-bacterial &amp; anti-inflammatory properties. This is a potent serum as it intensively ', 'Somethinc_Box_no_frame_Vita_Propolis.png', 'C0001', 100),
(10, 'Hylapore Away Solution', 119000, 'Hylapore Away Solution&nbsp;Combat Large Pores &amp; Oily SkinGet rid of large pores &amp; reduce excess sebum/oil up to 30%* with the treatment from Vegan ingredients such as Cleome Gynandra Leaf Extract, Zinc PCA, Mastic Gum &amp; Palmitoyl Tripeptide-38. It has been clinically tested to help tighten pores, reduce redness on skin &amp; control excess sebum production so that pores on the ', 'Somethinc_Box_no_frame_Hylapore.png', 'C0001', 100),
(11, 'Lemonade Waterless Vitamin C + Ferulic + NAG', 129000, 'Lemonade Waterless Vitamin C + Ferulic + NAG&nbsp;Potent Antioxidant Brightening Waterless Vit. CInspired by the glowing look of Korean Glass Skin, this serum combines trio powerful brightening &amp; antioxidant agents: Vitamin C (EAA) &amp; NAG &amp; Ferulic, which have a perfect synergistic effect to brighten up skin, also 67% Jeju lemon extract water which is rich in antioxidants, hence it is ', 'Lemonade-1.jpg', 'C0001', 100),
(12, 'RESURRECT Multibiome Serum', 89000, 'RESURRECT Multibiome Serum&nbsp;PRE, PRO, POST T0 Renew Troubled Skin!&nbsp;This neutralizer &amp; balancer serum is a solution for those experiencing skin breakouts with Millions Microbiome Balancer in One Drop so as to prevent skin problems due to skin microbiota imbalance. This disorder usually occurs due to lifestyle such as the use of cleaning products, skin chafing with masks, clothes or shaving. When ', 'Somethinc_Box_no_frame_Resurrect_.png', 'C0001', 100),
(13, 'Revive Potion 3% Arbutin + Bakuchiol', 99000, 'Revive Potion 3% Arbutin + Bakuchiol&nbsp;SUPERSTAR MAX BRIGHTENING SKIN RESULT&nbsp;A serum infused with 3 Superstar Brightening Agent that produce Maximum Brightening Result, namely Alpha Arbutin, SabiWhite&reg;, &amp; Bakuchiol which are able to brighten &amp; even out skin tone without side effects. It is enhanced with Bakuchiol which is able to protect skin from pollution and free radicals, fade hyperpigmentation and prevent ', 'Somethinc_Box_no_frame_Revive_Potion.png', 'C0001', 100),
(14, 'Skin Defender Bakuchiol + COQ10 Serum', 39000, 'Skin Defender Bakuchiol + COQ10 Serum&nbsp;Maximum Protection &amp; Crystal SkinPowerful combination of Bakuchiol, CoQ10 &amp; PALMITOYL TRIPEPTIDE-38 which are effective to help strengthen collagen tissue, prevent signs of premature aging, neutralize free radicals &amp; protect skin damage caused by UV rays, pollution or external exposure. This serum complements the 3 important components that are essential for skin barrier (Squalane, Ceramide, Hyaluronic ', 'Somethinc_Box_no_frame_Skin_Defender.png', 'C0001', 100),
(15, 'Level 1% Encapsulated Retinol', 155000, 'Level 1% Encapsulated Retinol&nbsp;ENCAPSULATED RETINOL FOR BEGINNER TO INTERMEDIATE USERLevel-Up Encapsulated Retinol that is effective to reduce the appearance of fine wrinkles, help tighten skin, maintain youthful &amp; supple skin, hence it is known as the Gold Standard for Anti-Aging. It is supported with Encapsulation Technology, making it more stable &amp; having 2x higher efficacy than regular retinol yet still feels ', 'Somethinc_Box_no_frame_Encapsulated.png', 'C0001', 100),
(16, 'AHA 7%, BHA 1%, PHA 3% Weekly Peeling Solution', 125000, 'AHA 7%, BHA 1%, PHA 3% Weekly Peeling Solution&nbsp;GET RID OF BLACKHEADS &amp; CLOGGED PORES FOR GOOD!&nbsp;Stronger % Dose peeling option for you who are used to AHA BHA PHA actives, infused with Mugwort &amp; Calendula to level up your exfoliation routine! Helps clean clogged pores, remove dead skin cells, fade acne scars, help brighten skin, maintain skin moisture, &amp; get ', 'Somethinc_Box_no_frame_AHA713.png', 'C0001', 100),
(17, 'HYALuronic9+ Advanced + B5 Serum', 115500, 'HYALuronic9+ Advanced + B5 Serum&nbsp;48HR Hydration Lock to Keep Skin Hydrated!Contains 9 types of Hyaluronic Acid, B5 (Panthenol) &amp; Chlorella, has an essential role in stimulating collagen &amp; locking maximum hydration for 48 hours into the deepest layer of the skin! Calm the skin &amp; cleanse off skin pores. Suitable for all skin type &amp; sensitive skin.#CHOOSEYOURDOSE&nbsp;QUICK FACTS:NA18210102692HOW TO USE:Apply 3-5 ', 'HYALuronic9+_Advanced_+_B5_Serum.jpg', 'C0001', 100),
(18, '10% Niacinamide Barrier Serum', 115500, 'QUICK FACTS:FOR BETTER SKIN BARRIER &amp; OIL CONTROL Reduce dark spots Reduce redness Vegan Friendly Fungal Acne Friendly Dermatologically Certified Hypoallergenic Suitable for sensitive skin Non-irritation formula Teenagers friendly HALAL MUI CertifiedBPOM CertifiedNA18210103336HOW TO USE:Apply 5-10 drops of serum into your palm.Lightly pat your palms onto your cleaned face.Wait for 1-3 minutes for the product to fully absorb.Can be used every ', 'Somethinc_Box_no_frame_10%_Barrier_20ml.png', 'C0001', 100),
(19, '5% Niacinamide Barrier Serum', 89000, '5% Niacinamide Barrier Serum&nbsp;SAY GOODBYE TO OILY, DULL &amp; DAMAGED SKIN BARRIER!&nbsp; 5% Niacinamide OG, a vegan formula with 3 types of Ceramide &amp; Hydrolyzed Algae Extract. Helps strengthen skin barrier, brighten, disguise dark spots/hyperpigmentation, reduce acne, redness, moisturize skin, &amp; minimalize dry chapped skin. #CHOOSEYOURDOSE &nbsp;&nbsp;QUICK FACTS:NA18210103336HOW TO USE:POWERED WITH:48% Rosa Damascena Flower WaterHelps reduce signs of premature aging, reduce ', 'Somethinc_Box_no_frame_5%_Barrier_20ml.png', 'C0001', 100),
(20, 'Holygrail Multipeptide Youth Elixir', 129000, 'Holygrail Multipeptide Youth Elixir&nbsp;GET YOUR YOUTHFUL SKIN BACK IN 15 DAYS! &nbsp;Anti Aging Elixir helps to tighten &amp; restore your skin elasticity by reducing muscle movement that can create wrinkles &amp; fine lines. Formulated with 65% Rosa Damascena Water, SYN&reg;-AKE &amp;&nbsp;Argireline&nbsp;(known as BOTOX LIKE EFFECT) &amp; other 10 human-identical peptides.&nbsp;#AgeDontCare&nbsp;QUICK FACTS:&nbsp;Contains of 12 Powerful peptides as Youth Elixir Get your youthful ', 'Somethinc_Box_no_frame_Holygrail.png', 'C0001', 100),
(21, 'Salmon DNA + Marine Collagen Elixir', 155000, 'Salmon DNA + Marine Collagen Elixir&nbsp;MILLIONAIRE TREATMENT SALMON DNA TO RESCUE AGINGSkin Booster elixir from deep blue ocean, infused with 62% Deep Sea Water, Salmon DNA, Pseudoalteromonas Ferment Extract, Hydrolyzed Marine Collagen, &amp; Pearl. Promotes skin elasticity, Revitalize uneven skin texture, Boost Collagen 1 &amp; 4 production, Skin regeneration, &amp; Restoring back your Skin\'s Glow.#AgeDontCare&nbsp;QUICK FACTS:NA18210102583&nbsp;HOW TO USE:&nbsp;POWERED WITH:62% Deep Sea ', 'Somethinc_Box_no_frame_Salmon.png', 'C0001', 100),
(22, 'CRIOUSLY 24K GOLD Essence', 119500, 'CRIOUSLY 24K GOLD Essence&nbsp;HYBRID 2-IN-1 BRIGHTENING ESSENSE &amp; MAKEUP PREP Stabilized Vitamin C (Ascorbil Glucoside), doesn\'t exidized easily and helps to brighten the skin. Infused with 24k Gold, preserve key substances skin needs to look smoother, visibly target dullness, uneven tones, brighter, and younger. It can also be used as make-up based to give a healthy glowing finish. NOTE: DO NOT ', 'Somethinc_Box_no_frame_24K_Gold.png', 'C0001', 100),
(23, '10% Niacinamide + Moisture Sabi Beet Max Brightening Serum', 115500, '10% Niacinamide + Moisture Sabi Beet Max Brightening Serum&nbsp;GET YOUR #BrightBeautifully SKIN IN 4 WEEKS! Niacinamide 10% with SABIWHITE x BEET as #1 Brightening Agent. Helps you to achieve a maximum level of crystal bright skin, improve your skin texture, strengthen skin barrier, disguise dark spots &amp; hyperpigmentation on the skin, moisturize, restores suppleness, reduces redness, acne-fighting, &amp; minimizes the appearance ', 'Hansohee_Niacinamide_Sabi-10.jpg', 'C0001', 100),
(24, '5% Niacinamide + Moisture Sabi Beet Serum', 89000, '5% Niacinamide + Moisture Sabi Beet Max Brightening Serum&nbsp;GET YOUR #BrightBeautifully SKIN IN 4 WEEKS!&nbsp;Niacinamide 5% with SABIWHITE x BEET as #1 Brightening Agent. Helps you to achieve a maximum level of crystal bright skin, improve your skin texture, strengthen skin barrier, disguise dark spots &amp; hyperpigmentation on the skin, moisturize, restores suppleness, reduces redness, acne-fighting, &amp; minimizes the appearance of ', 'Somethinc_Box_no_frame_5%_Sabi_20ml.png', 'C0001', 100),
(25, 'BAKUCHIOL Skinpair Oil Serum', 89000, 'HOW TO USE:&nbsp;&nbsp;POWERED WITH:Bakuchiol (Pharmaceutical Grade)It works as anti-inflammatory as well as antioxidant so that it becomes a natural alternative for Retinol. Bakuchiol triggers skin cell regeneration thereby helping to reduce the appearance of fine lines, &amp; hyperpigmentation without causing skin inflammation.Sunflower Seed Oil (Ecocert)A potent antioxidant that is rich in Fatty Acids, A, C, E, K &amp; D vitamins which ', 'Somethinc-Local-Serum-Bakuchiol-Oil-Skinpair-20ml1.jpg', 'C0001', 100),
(26, 'AHA BHA PHA Peeling Solution 20ml', 115500, 'AHA BHA PHA Peeling Solution&nbsp;GET RID OF CLOGGED PORES FOR GOOD!&nbsp;Get Rid of Blackheads &amp; Clogged Pores for Good! Exfoliating serum with AHA 3% BHA 1% PHA 2% helps to remove dead skin cells, reduce clogged pores &amp; comedones, while maintaining skin moisture level.&nbsp;&nbsp;QUICK FACTS:NA18200100487HOW TO USE:POWERED WITH:Glycolic Acid (AHA)AHA works in the skin layer of the epidermis stratum corneum to ', 'Somethinc_Box_no_frame_AHA.png', 'C0001', 100),
(27, 'Bacne 1% Biosalicylic Spray - Hello Kitty Edition', 75000, 'Bacne 1% Biosalicylic Spray - Hello Kitty Edition&nbsp;2X POWERFUL BODY ACNE TREATMENT&nbsp;A Fungal-acne friendly body spray with 360∘ Movement, which makes it easy to use on hard-to-reach body parts. Formulated with Biosalicylic Acid (a new generation of salicylic acid that is gentler on the skin) &amp; Piroctone Olamine which works against bacteria &amp; fungi that cause body acne as well as ', 'BACNE_1__Biosalicylic_Spray_Hello_Kitty_Ver1.jpg', 'C0002', 100),
(28, 'Axillary Brightening Cream - Hello Kitty Edition', 79000, 'Axillary Brightening Cream - Hello Kitty Edition&nbsp;4X BRIGHTEN UNDERARMS &amp; DARK FOLDS IN 4 WEEKS*&nbsp;A brightening cream with 4X BRIGHT formula to lighten dark skin folds on the body such as underarms, elbows, knees, inner thighs, &amp; other dark folds in 4 weeks*. Enhanced with Sabiwhite&reg;, Niacinamide, Chromabright, &amp; Mandelic Acid which brightens, smoothes skin texture, &amp; can be used after ', 'Axillary_Brightening_Cream_Hello_Kitty_Ver1.jpg', 'C0002', 100),
(29, 'Axillary Brightening Cream', 79000, 'Axillary Brightening Cream&nbsp;4X BRIGHTEN UNDERARMS &amp; DARK FOLDS IN 4 WEEKS*A brightening cream with 4X BRIGHT formula to lighten dark skin folds on the body such as underarms, elbows, knees, inner thighs, &amp; other dark folds in 4 weeks*. Enhanced with Sabiwhite&reg;, Niacinamide, Chromabright, &amp; Mandelic Acid which brightens, smoothes skin texture, &amp; can be used after waxing/shaving.&nbsp;#RespectMyBody #KetiKinclong&nbsp;*based on internal ', 'Axillary_Brightening_Cream1.jpg', 'C0002', 100),
(30, 'Bacne 1% Biosalicylic Spray', 75000, 'Bacne 1% Biosalicylic Spray&nbsp;2X POWERFUL BODY ACNE TREATMENT&nbsp;A Fungal-acne friendly body spray with 360∘ Movement, which makes it easy to use on hard-to-reach body parts. Formulated with Biosalicylic Acid (a new generation of salicylic acid that is gentler on the skin) &amp; Piroctone Olamine which works against bacteria &amp; fungi that cause body acne as well as cleaning dirt from clogged ', 'BACNE_1__Biosalicylic_Spray1.jpg', 'C0002', 100),
(31, 'Acnedot Clear AC Body Soap', 29000, 'Acnedot Clear AC Body Soap&nbsp;2X POWERFUL BODY ACNE TREATMENTA bar soap for acne-prone body skin that cleanses the skin from dead skin cells, dirt, &amp; excess oil that cause clogged pores. Formulated with Bamboo Charcoal &amp; Succinic Acid that fight acne-causing bacteria, absorb dirt, &amp; keep pores clean. The gentle formula keeps your skin moisturized &amp; does not dry out your ', 'Body_Care_Website-05.jpg', 'C0002', 100),
(32, 'Bust Firming Serum', 119000, 'Bust Firming Serum&nbsp;weight : 50mlNEVER LET YOU DOWN! YOUR BUST SUPPORT SYSTEM &nbsp; Wonderful bust serum that works like A PUSH UP BRA! Equipped with Pullulan &amp; Natural Instant Lifter to maintain breast firmness &amp; increase skin elasticity quickly. Formulated with a combination of Bakuchiol &amp; Dictyopteris Algae to maintain firmness &amp; increase breast volume in 28 days*. Light in texture, ', 'Bust_Firming-2.png', 'C0002', 100),
(33, 'Botanical Heritage Oil Serum', 179000, 'Botanical Heritage Oil Serumweight : 40ml&nbsp;EXPERIENCE THE TRUE HERITAGE OF LUXURY IN A BOTTLE! 99.9% Multipurpose Natural Oil for face, body, &amp; nails. It is lightweight &amp; easy to absorb, this oil serum contains full-of-nutrients 10 Precious Botanical Oils that have antibacterial, antioxidant, and soothing properties. Equipped with the #1st Most Expensive Spice in The World, Saffron Extract. It makes skin ', 'Botanical_Heritage1.png', 'C0002', 100),
(34, 'Skin Goals Brightening Body Creme', 75000, 'Skin Goals Brightening Body Creme&nbsp;weight : 100mlMAXIMUM #BRIGHTBEAUTIFULLY IN 28 DAYS Brightening Body Cr&egrave;me contains Triple Powerful Brightening Ingredients: Alpha Arbutin, Rainbow Algae, &amp; Bergamot Oil which function as Dull Skin Eraser. Enriched with &nbsp;CoQ10 Beads Pill as an antioxidant to prevent premature aging. It has a light texture that is easy to absorb, Non-Greasy &amp;&nbsp; has a fresh Bergamot aroma. ', 'Skin_Goals-31.png', 'C0002', 100),
(35, 'Bakuchiol R-Cover Firming Body Crème', 75000, 'Bakuchiol R-Cover Firming Body Cr&egrave;me&nbsp;weight : 100ml&nbsp;3-in-1 BACK TO YOUTH STRETCH MARK BODY CREME  3-in-1 Body Cr&egrave;me that helps reduce stretch marks in 28 days*. Enriched with Bakuchiol, Chlorella Extract, &amp; cross-linked Hyaluronic Acid which maintain firmness as well as hydrating the skin so as to keep it moist &amp; elastic. Light in&nbsp; texture, easy to absorb, &amp; not sticky, ', 'BakuchiolRCover-NoFrame.jpeg', 'C0002', 100),
(36, 'CERAMIC SKIN Saviour Moisturizer Gel (Reformulated)', 299000, 'Ceramic Skin SaviourHYDRATE, REVIVE, &amp; STRENGTHEN YOUR SKIN BARRIERSuper Moisturizing Gel-Cream complete with 10 Advanced Skin-Loving Ingredients that are proven to lock-in moisture for up to 24 hours! With Marine Collagen, Palmitoyl Tripeptide, Sodium Hyaluronate, &amp; Ceramide that will strengthen the skin barrier, brighten, anti-aging, &amp; fade dark spots.&nbsp;Feel the sensation of 24-hour moisture, act as a moisturizer for a healthier ', 'Ceramic-Cover-NoFrame1.jpg', 'C0003', 100),
(37, '(REFILL) Ceramic Skin Saviour Moisturizer Gel - Reformulated', 229000, 'Ceramic Skin SaviourHYDRATE, REVIVE, &amp; STRENGTHEN YOUR SKIN BARRIERSuper Moisturizing Gel-Cream complete with 10 Advanced Skin-Loving Ingredients that are proven to lock-in moisture for up to 24 hours! With Marine Collagen, Palmitoyl Tripeptide, Sodium Hyaluronate, &amp; Ceramide that will strengthen the skin barrier, brighten, anti-aging, &amp; fade dark spots. Feel the sensation of 24-hour moisture, a healthier skin barrier, &amp; a ', 'PS_Refill_Ceramic_Skin_Saviour_50ml_10x_Skin_Loving_1_(1).png', 'C0003', 100),
(38, 'VITA PROPOLIS Hydra Power Mist', 135000, 'VITA PROPOLIS Hydra Power Mist&nbsp;SOOTHE, HYDRATE, BALANCE&nbsp;An Alcohol-Free Ultra Fine Face mist with Superfood Bee Glow Power &amp; Smart Oil Balancer Technology to soothe, nourish, &amp; hydrate the skin throughout the day. Somethinc face mist is combined by Korean Propolis to nourish the skin, Japanese Rice to balance water &amp; sebum, &amp; Beet Extract which hydrates even the deepest layer of ', 'PS_Vita_Propolis_Hydra_Power_Mist_135ml_1.png', 'C0003', 100),
(39, 'BEE POWER Propolis & Manuka Honey Sleeping Mask', 129000, 'BEE POWER Propolis &amp; Manuka Honey Sleeping Mask&nbsp;HYDRATE, NOURISH, BALANCE&nbsp;Somethinc sleeping mask containing Superfood Bee Power Glow: Korean Propolis, Manuka Honey, &amp; Bee Venom which intensely provides moisture &amp; nutrients to your skin during the night for you skincare routine. The light gel texture, non-comedogenic (does not give clog pores), easy to absorb, &amp; non-sticky formula make the skin more glowing ', 'PS_Bee_Power_Propolis___Manuka_Honey_50gr_5.png', 'C0003', 100),
(40, 'SKIN GOALS Moisture Silk Cremè', 39000, 'SKIN GOALS Moisture Silk Crem&egrave;&nbsp;YOUR SKIN GOALS IS HERE! Get #BrightBeautifully Skin in 28 Days A super lightweight vegan gel-cream moisturizer with 5X Brightening POWER to brighten skin &amp; reduce dark spots in 28 days. Equipped with 3D Aqua Seal Technology which provides moisture, strengthens the skin barrier, helps you to achieve smoother, supple, &amp; glowing skin. *In vivo experimental results ', 'Skin_Goals_-_Moisture_Silk_Creme.png', 'C0003', 100),
(41, 'SOS Bakuchiol Electrolyte Rich Moisturizer Silk Creme', 39000, 'SOS Bakuchiol Electrolyte Rich Moisturizer Silk Creme&nbsp;SKIN REINCARNATION DAY MOISTURIZER: YOUTHFUL &amp; GLOW SKIN RECHARGE&nbsp;A 100% vegan anti-aging day cream with a combination of 4 natural super plants: Bakuchiol, Deep sea water, Gardenia Jasminoides, &amp; Lemon water to reduce fine lines &amp; wrinkles as well as maintaining youthful skin. Contains rich electrolytes obtained from Noirmoutier Deep Sea Water to brighten &amp; ', 'SOS_Bakuchiol.png', 'C0003', 100),
(42, 'ACNEDOT Treatment Moisturizer Gel', 29000, 'ACNEDOT Treatment Moisturizer Gel&nbsp;GET RID OF ACNE POREBLEM IN 28 DAYS&nbsp;A vegan facial moisturizer with 5X Acne Combat Power that helps fight acne-causing bacteria, minimizes the appearance of pores, controls excess sebum, &amp; reduces acne-causing bacteria in 28 days*. Equipped with Postbiotics to support the skin regeneration process &amp; balance the microbiome in the skin. It comes in a lightweight gel ', 'Acnedot_Treatment_-_Moisturizer_Gel.png', 'C0003', 100),
(43, 'PEPTINOL Granactive Retinoid + Peptide Night Moisturizer Creme', 39000, 'PEPTINOL Granactive Retinoid + Peptide Night Moisturizer Creme&nbsp;SKIN REINCARNATION&nbsp;NIGHT MOISTURIZER: YOUTHFUL GLOW SKIN REPAIR &amp; HYPERPIGMENTATION CORRECTOR#BASICskincareMatters #AgeDontCare&nbsp;&nbsp;QUICK FACTS:NA18210106218HOW TO USE:1. Cleanse your face with Somethinc Low pH Gentle Jelly Cleanser 2. Use your favorite Somethinc toner all over your face 3. Apply your favorite Somethinc serum 4. Apply PEPTINOL 1% Granactive Retinoid + Peptide Night Moisturizer Creme all over the ', 'Peptinol.png', 'C0003', 100),
(44, 'Supple Power Hyaluronic9+Onsen Moisture Bomb Gel', 249000, 'Supple Power Hyaluronic9+Onsen Moisture Bomb Gel&nbsp;65% Onsen Hydra Bank to provide 24HR Deep Moisture Lock24 HR Moisture Lock Moisturizer with 65% Onsen Sui Water, total hydration with 9 Hyaluronic Acid &amp; Ceramide Complex with skin-identical barrier components. To rejuvenate skin, increase collagen production, defy aging to keep skin healthy &amp; supple all day. With lightweight texture &amp; non-comedogenic, formulated for all ', 'SupplePower-1.jpg', 'C0003', 100),
(45, 'ACNEDOT Treatment Low pH Cleanser', 99000, 'ACNEDOT Treatment Low pH Cleanser&nbsp;GET RID OF ACNE POREBLEM IN 28 DAYS&nbsp; A pH balanced vegan facial cleanser which has 5X Acne Combat Power ability to help clean pores as well as removing dirt, dead skin cells, residue, &amp; excess oil that can cause acne. It contains Non-stripping &amp; non-drying formula as well as Tea Tree which functions as antibacterial to ', 'Acnedot_Treatment_Low_Ph_Cleanser.png', 'C0004', 100),
(46, 'Omega Butter Deep Cleansing Balm', 45000, 'Omega Butter Deep Cleansing Balm&nbsp;20 SECS BALM TO MELT THE DIRT AWAYA vegan cleanser in the form of a soft balm that is infused with antioxidants Botanical Extracts, OMEGA 3-6-9, Vitamins A &amp; E that removes all dirt, excess sebum, makeup, &amp; waterproof sunscreen in 20 seconds without leaving any residue or causing a burning sensation, leaving the skin clean &amp; ', 'SOMETHINC_Omega_Butter_Deep_Cleansing_Balm.jpg', 'C0004', 100),
(47, 'Reset Gentle Micellar Cleansing Water', 45000, 'Reset&nbsp;Gentle Micellar Cleansing Water&nbsp;MAGIC WATER FOR EVERYDAY SWIPE AWAYA vegan Micellar Water with NON-IONIC SURFACTANT that does not penetrate the skin &amp; does not attract natural oil sebum, so it is very comfortable for daily use without drying the skin &amp; damaging the skin barrier.&nbsp; It removes light make-up, sunscreen &amp; refreshes the skin after a day\'s activities.#SELFPAMPERINC&nbsp; #CleanseItYourWay&nbsp;QUICK FACTS:NA18211203049&nbsp;How to ', 'SOMETHINC_Reset_Gentle_Micellar_Cleansing_Water_11.jpg', 'C0004', 100),
(48, 'Alpha Squalaneoxidant Deep Cleansing Oil', 69000, 'Alpha Squalaneoxidant Deep Cleansing Oil&nbsp;DEEPLY CLEANSE OFF WITHOUT CLOGGING PORESA vegan cleansing oil that works well to clean waterproof makeup, sebum, dust, &amp; dirt completely. Equipped with MICELLE TECHNOLOGY which has the ability to bind dirt &amp; turn it into milky texture when in contact with water, thus making the skin clean without leaving any residue &amp; it is non-stripping. #SELFPAMPERINC&nbsp; ', 'Alpha_Squalaneoxidant_Deep_Cleansing_Oil_1.jpg', 'C0004', 100),
(49, 'Low pH Gentle Jelly Cleanser', 99000, 'Low pH Gentle Jelly Cleanser&nbsp;NON-STRIPPING LOW pH BALANCER GENTLE CLEANSERA vegan-based facial cleanser with jelly texture &amp; formulated with gentle ingredients such as Japanese Mugwort &amp; Tea Tree. Clinically tested to balance skin pH without drying, stripping, &amp; damaging the skin barrier. #SomethincJelly&nbsp;&nbsp;QUICK FACTS:Non-stripping &amp; GentleSkin pH Balancer VEGAN FormulatedMugwort to calm rednessCleanse off dirt and excess sebumHypoallergenic&nbsp;Suitable for sensitive skinNon-Irritation ', 'Jelly-1.jpg', 'C0004', 100),
(50, 'Calm Down! PHA 3% Soothing Everyday Toner - ANNIVERSARY EDITION', 59000, 'Calm Down! PHA 3% Soothing Everyday Toner - ANNIVERSARY EDITION&nbsp;KEEP CALM &amp; CHILL! YOUR SENSITIVE SKIN BESTIE TO RESCUE&nbsp;A soothing toner formulated with Madagascar Centella Asiatica &amp; Adaptogenic Cherimoya which helps soothe redness, sensitive skin &amp; mild skin irritation. Equipped with 3% PHA that effectively removes impurities, including dead skin cells that cause blackheads &amp; dull skin. Helps fade PIE acne ', 'Packshot_Toner_3rd_Anniv_No_Frame_Calm_Down!_PHA_3%_Soothing_Everyday_Toner_-_ANNIVERSARY_EDITION.png', 'C0006', 100),
(51, 'Somethinc SUPPLE POWER Hyaluronic 9+ Onsen Essence Toner - ANNIVERSARY EDITION', 89000, 'SUPPLE POWER Hyaluronic9+ Onsen Essence Toner&nbsp;48HR DEEP HYDRATION LOCK &amp; NOURISHMENT WITH 9 LAYERS OF HYALURONIC ACID &amp; AUTHENTIC ONSEN SUI WATERDiscover the freshness of 79% Onsen Belgium Hot Spring Water &amp; 9 Layers of Hyaluronic Acid, which hydrates the skin to the deepest pores. Rich in minerals to provide maximum moisture in every skin\'s layer, maintain skin elasticity, balance skin ', 'Packshot_Toner_3rd_Anniv_No_Frame_Somethinc_SUPPLE_POWER_Hyaluronic_9+_Onsen_Essence_Toner_-_ANNIVERSARY_EDITION.png', 'C0006', 100),
(52, 'Glow Maker AHA BHA PHA Clarifying Treatment Toner - ANNIVERSARY EDITION', 59000, 'GLOW MAKER AHA BHA PHA Clarifying Treatment Toner&nbsp;DAILY EXFOLIATING TONER FOR BEGINNERS&nbsp;A Mild Daily Exfoliating Toner that is suitable for beginners or sensitive skin. Exfoliate from the skin\'s deepest layer to the outermost layer. Clinically proven to get rid of dead skin cells, unclogged pores, soften your skin texture, even out skin tone, removes the remaining dirt so that the skin ', 'Packshot_Toner_3rd_Anniv_No_Frame_Glow_Maker_AHA_BHA_PHA_Clarifying_Treatment_Toner_-_ANNIVERSARY_EDITION.png', 'C0006', 100),
(53, 'SKIN GOALS Vita Propolis Glow Essence Toner', 139000, 'SKIN GOALS Vita Propolis Glow Essence Toner&nbsp;YOUR SKIN GOALS IS HERE! #BrightBeautifully Skin in 28 Days!A pH Balanced toner containing Vit C (EAA), Korean Propolis, New Zealand Manuka Honey, to nourish &amp; brighten your skin in 28 days*. Enriched with Pro-Vitamin B5 which moisturizes &amp; makes your skin healthier &amp; glowing all day long. #BrightBeautifully #RealisticWhite #BASICskincareMatters&nbsp;*based on in vivo experimental ', 'Skin_Goals_Vita_Propolis_Glow_Essence_Toner_100ml_1.png', 'C0006', 100),
(54, 'ACNEDOT Treatment Toner', 125000, 'ACNEDOT Treatment Toner&nbsp;GET RID OF ACNE POREBLEM IN 28 DAYS&nbsp; A vegan pH balance toner for acne-prone skin that helps minimize the appearance of pores &amp; balances excess oil. It contains 5X Acne Combat Power &amp; 91% Korean Green Tea Water to fight acne-causing bacteria while calming redness on acne-prone skin. #AcneSolver #BASICskincareMatters&nbsp;&nbsp;QUICK FACTS:NA18210108442&nbsp;&nbsp;&nbsp;&nbsp;HOW TO USE:1. Cleanse your face with Somethinc ', 'Acnedot_Treatment_Toner_100ml.png', 'C0006', 100),
(55, 'Glow Maker AHA BHA PHA Clarifying Treatment Toner - Hello Kitty Edition', 119000, 'Glow Maker AHA BHA PHA Clarifying Treatment Toner - Hello Kitty Edition&nbsp;DAILY EXFOLIATING TONER FOR BEGINNERSA Mild Daily Exfoliating Toner that is suitable for beginners or sensitive skin. Clinically proven to get rid of dead skin cells, unclog pores, soften your skin texture, even out skin tone, removes the remaining dirt so that the skin becomes cleaner, smoother &amp; healthier. Let ', 'Glow_Maker_AHA_BHA_PHA_Clarifying_Treatment_Toner_-_Hello_Kitty_Edition.jpg', 'C0006', 100),
(56, 'SUPPLE POWER Hyaluronic 9+ Onsen Essence Toner - Hello Kitty Edition', 199000, 'SUPPLE POWER Hyaluronic 9+ Onsen Essence Toner - Hello Kitty Edition&nbsp;48HR DEEP HYDRATION LOCK &amp; NOURISHMENT WITH AUTHENTIC ONSEN SUI WATER&nbsp;A hydrating toner with the freshness of 79% Onsen Belgium Hot Spring Water &amp; 9 Layers of Hyaluronic Acid, which hydrates the skin to the deepest pores, maintain skin elasticity, balance skin pH after exfoliation &amp; prepare skin to absorb serum ', 'SUPPLE_POWER_Hyaluronic_9+_Onsen_Essence_Toner_-_Hello_Kitty_Edition.jpg', 'C0006', 100),
(57, 'SUPPLE POWER Hyaluronic9+ Onsen Essence Toner', 199000, '48HR DEEP HYDRATION LOCK &amp; NOURISHMENT WITH 9 LAYERS OF HYALURONIC ACID &amp; AUTHENTIC ONSEN SUI WATER  Discover the freshness of 79% Onsen Belgium Hot Spring Water &amp; 9 Layers of Hyaluronic Acid, which hydrates the skin to the deepest pores. Rich in minerals to provide maximum moisture in every skin\'s layer, maintain skin elasticity, balance skin pH after exfoliation ', 'Somethinc_SupplePower_Duo_PackShot_800x9801.jpg', 'C0006', 100),
(58, 'GLOW MAKER AHA BHA PHA Clarifying Treatment Toner', 119000, 'GLOW MAKER AHA BHA PHA Clarifying Treatment Toner&nbsp;DAILY EXFOLIATING TONER FOR BEGINNERS&nbsp; A Mild Daily Exfoliating Toner that is suitable for beginners or sensitive skin. Exfoliate from the skin\'s deepest layer to the outermost layer. Clinically proven to get rid of dead skin cells, unclogged pores, soften your skin texture, even out skin tone, removes the remaining dirt so that the ', 'Somethinc_GlowMaker_Duo_PackShot_800x9801.jpg', 'C0006', 100),
(59, 'No Sebum Mineral Blur Translucent Loose Powder SPF39 PA++++', 99000, 'No Sebum Mineral Blur Translucent Loose Powder SPF39 PA++++Sunscreen Powder&nbsp;&nbsp;Easy Touch-Up Sunscreen with Oil-control &amp; Pore Blurring EffectA loose powder sunscreen SPF39 PA++++ that protects your skin from UVA &amp; UVB as well as controlling oil &amp; blurring out large pores. Perfect for reapplying sunscreen without ruining your makeup anytime &amp; anywhere!#SunTerror #Holyshield&nbsp;&nbsp;QUICK FACTS:NA18220400178HOW TO USE:Use as the last step of ', 'PS_No_Sebum_Mineral_Blur_Translucent_Loose_Powder_11gr_2.png', 'C0007', 100),
(60, 'Holyshield! UV Watery Sunscreen Gel SPF 50+ PA++++', 23000, 'Holyshield! UV Watery Sunscreen Gel SPF 50+ PA++++&nbsp;5-IN-1 COOLING AQUA PROTECTION&nbsp;Sunscreen Gel with SPF 50+ PA++++ &amp; Encapsulated UV Filter technology that provides maximum protection from UVA &amp; UVB rays. It gives protection against Pollution, Blue-Light, &amp; Infra-Red that help prevent signs of aging. With Snowflake Molecules to serve a cooling sensation &amp; absorb into your skin like water. All-day comfort, ', 'SUN_PDP_UV_Watery.jpg', 'C0007', 100),
(61, 'Holyshield! Sunscreen Shake Mist SPF46 PA+++', 109000, 'Holyshield! Sunscreen Shake Mist SPF46 PA+++&nbsp;Protect your skin from #SunTerrorApply &amp; Re-apply Wherever You Go &amp; Whenever You WantAlcohol-Free Sunscreen Shake Mist with SPF 46 PA+++. Equipped with Encapsulated UV Filter technology that provides maximum protection from UVA &amp; UVB. Easy to re-apply without ruining your Makeup, No White Cast, Non-Greasy, &amp; get that Healthy Glow Finish!&nbsp;QUICK FACTS:NA18211701822HOW TO USE:1. Use ', 'Holyshield_Somethinc_6.png', 'C0007', 100),
(62, 'Glowing Up Sunscreen Stick SPF 50++ PA ++++', 125000, 'Glowing Up Sunscreen Stick SPF 50++ PA ++++&nbsp;GLIDES EASILY WITHOUT BEING GREASY &amp; STICKY Transparent sunscreen stick with SPF50+ PA++++ that can block UVA &amp; UVB radiation. The texture is light so it\'s easy to absorb, doesn\'t clog pores &amp; doesn\'t ruin makeup. It enhances protection &amp; appearance as it gives a healthy glow finish that is neither sticky nor greasy. ', 'Glowing_Up_Sunscreen_Stick_SPF_50+_PA_++++.jpg', 'C0007', 100),
(63, 'Holyshield! Sunscreen Comfort Corrector Serum SPF 50+ PA++++', 69000, 'Holyshield! Sunscreen Comfort Corrector Serum SPF 50+ PA++++&nbsp;SKIN CORRECTION &amp; SUN PROTECTION ALL DAY Skin Redness Correction &amp; Multitask Sunscreen SPF 50+ PA++++ protects skin from UVA &amp; UVB, functions as a color corrector that brightens &amp; evens out skin tone. It is light in texture, hence it absorbs quickly, non sticky &amp; gives a Satin finish. It functions as an ', 'Holyshield!_Sunscreen_Comfort_Corrector_Serum_SPF_50+_PA++++_1.jpg', 'C0007', 100),
(64, 'SKIN GOALS Brightening Glow 10 Minutes Wash Off Mask - Hello Kitty Edition', 89000, 'SKIN GOALS Brightening Glow 10 Minutes Wash Off Mask - Hello Kitty Edition&nbsp;EMERGENCY CARE FOR BRIGHT &amp; SATIN SKIN- 10 MINUTES CLAY MASKClay mask with Quadruple Brightening Complex combination: SabiWhite, G2Light, Alpha Arbutin, Glutathione to help brightens the skin and reduce hyperpigmentation. With the addition of Marine Collagen, this Clay Mask helps to keep your skin elasticity from your first try. ', 'SKIN_GOALS_Brightening_Glow_10_Minutes_Wash_Off_Mask_-_Hello_Kitty_Edition.jpg', 'C0008', 100),
(65, 'Mugwortella Charcoal Deep Pore Cleansing 10 Minutes Wash Off Mask', 89000, 'Mugwortella Charcoal Deep Pore Cleansing 10 Minutes Wash Off Mask&nbsp;EMERGENCY CARE FOR ACNE &amp; PORELESS SKIN - 10 MINUTES INSTANT CLAY MASKClean your pores &amp; absorb excess sebum with the power of Bentonite Clay, Kaolin, &amp; Charcoal. This effective instant clay mask is also infused with Mugwort, Centella Asiatica, Dead Sea Mud, 7 Natural Plants Power &amp; Strawberry Seeds, that will ', 'Mugwortella_Charcoal_Deep_Pore_Cleansing_10_Minutes_Wash_Off_Mask.jpg', 'C0008', 100),
(66, 'SKIN GOALS Brightening Glow 10-Minutes Wash Off Mask', 89000, 'SKIN GOALS Brightening Glow 10-Minutes Wash Off Mask&nbsp;EMERGENCY CARE FOR BRIGHT &amp; SATIN SKIN - 10 MINUTES INSTANT CLAY MASKConsists of Bentonite Clay, Kaolin, G2Light, &amp; SabiWhite, SKIN GOALS Brightening Glow 10-Minutes Wash Off Mask focuses to brighten your skin optimally with the use of 1-2 times/week. Reduce hyperpigmentation and keep your skin elasticity. Achieve your own version of perfect skin ', 'PackShot_Spatula-SkinGoals_800x800.jpg', 'C0008', 100),
(67, 'COFFEEINC Lip Scrub', 69000, 'Coffeeinc Lip Scrub&nbsp;A scrub from natural ingredients which are coffee beans &amp; apricots that can treat dry &amp; chapped lips. This scrub is a natural exfoliator that does not irritate the lips area when it is applied. Lips will always be smooth, moist &amp; fresh after regular use. Our special blend exfoliator uses coffee &amp; apricot which are gentle &amp; non-irritating.&nbsp;#COFFEEINC&nbsp;QUICK ', 'PS_Coffeinc_Lip_Scrub_2.png', 'C0009', 100),
(68, 'Somethinc x Kopi Kenangan - Coffeeinc Body Scrub', 89000, 'Coffeeinc Body Scrub&nbsp;SPECIAL BLEND NATURAL EXFOLIATOR TO GENTLY SCRUB DEAD SKIN CELLS OFF&nbsp;&nbsp;A unique body scrub made in collaboration with Kopi Kenangan, from the best Coffee Bean selection, and other natural exfoliators such as Cacao and Walnut, that removes dead skin cells &amp; brightens up your skin. Rich in natural antioxidants, this delicious scrub will keep your skin smooth &amp; awake!#SOMETHINCxKOPIKENANGAN ', 'SOMETHINC_Coffeeinc_Body_Scrub.jpg', 'C0009', 100),
(69, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Melembabkan', 264500, 'Bundle set details:Moisturizing- 1x Hyaluronic Serum 20ml- 1x Diamond Serum 20ml                                                   ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_MELEMBABKAN.jpg', 'C0010', 100),
(70, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Eksfoliasi', 274000, 'Bundle set details:Exfoliating- 1x AHA 7%, BHA 1%, PHA 3% Weekly Peeling Solution 20ml- 1x Diamond Serum 20ml                                            ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_EKSFOLIASI.jpg', 'C0010', 100),
(71, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Brightening', 278000, 'Bundle set details:Brightening- 1x Lemonade Waterless Vit C 20ml- 1x Diamond Serum 20ml                                                 ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_BRIGHTENING.jpg', 'C0010', 100),
(72, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Skin Barrier', 238000, 'Bundle set details:Skin Barrier- 1x RESURRECT Multibiome Serum 20ml- 1x Diamond Serum 20ml                                                 ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_SKIN_BARRIER.jpg', 'C0010', 100),
(73, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Anti Aging', 304000, 'Bundle set details:Anti Aging- 1x Level 1% Encapsulated Retinol 20ml- 1x Diamond Serum 20ml                                                ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_ANTI_AGING.jpg', 'C0010', 100),
(74, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Jerawat Minggat', 268000, 'Bundle set details:Acne Go Away- 1x 2% BHA Salicylic Acid 20ml- 1x Diamond Serum 20ml                                               ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_BEBAS_JERAWAT.jpg', 'C0010', 100),
(75, 'SOMETHINC [2 PCS] Paket Best Seller Layering Serum Berlian - Bekas Jerawat', 278000, 'Bundle set details:Acne Scars- 1x Dark Spot Ampoule 20ml- 1x Diamond Serum 20ml                                                 ', '[2_PCS_WEB]_PAKET_LAYERING_SERUM_BERLIAN_BEKAS_JERAWAT.jpg', 'C0010', 100),
(76, 'SOMETHINC [3 PCS] Paket Skincare Berlian with moisturizer - Skin Barrier', 407000, 'Bundle set details:Skin Barrier- 1x Resurrect Serum 20ml- 1x Diamond Serum 20ml- 1x Ceramic Skin Saviour Moisturizer 25ml                                            ', '[3_PCS_WEB]_PAKET_BERLIAN_MOISTURIZER_Meratakan_Tekstur_Kulit___Menjaga_Skin_Barrier.jpg', 'C0010', 100),
(77, 'SOMETHINC [3 PCS] Paket Skincare Berlian with moisturizer - Bebas Jerawat', 357000, 'Bundle set details:Acne Free- 1x 2% BHA Salicylic Acid 20ml- 1x Diamond Serum 20ml- 1x Acnedot Moisturizer 25ml                                            ', '[3_PCS_WEB]_PAKET_BERLIAN_MOISTURIZER_Meratakan_Tekstur_Kulit___Bebas_Jerawat.jpg', 'C0010', 100),
(78, 'SOMETHINC [3 PCS] Paket Skincare Berlian with moisturizer - Anti Aging', 397000, 'Bundle set details:Anti Aging- 1x Holygrail Serum 20ml- 1x Diamond Serum 20ml- 1x Peptinol Moisturizer 25ml                                              ', '[3_PCS_WEB]_PAKET_BERLIAN_MOISTURIZER_Meratakan_Tekstur_Kulit_Anti_Aging.jpg', 'C0010', 100),
(79, 'SOMETHINC [3 PCS] Paket Skincare Berlian with moisturizer - Brightening', 327000, 'Bundle set details:Brightening- 1x Diamond Serum 20ml- 1x 5% Niacinamide Sabi 20ml- 1x Skin Goals Moisturizer 25ml                                             ', '[3_PCS_WEB]_PAKET_BERLIAN_MOISTURIZER_Meratakan_Tekstur_Kulit___Mencerahkan.jpg', 'C0010', 100),
(80, 'SOMETHINC [3 PCS] Paket Skincare Berlian with moisturizer - Melembabkan', 393500, 'Bundle set details:Moisturizing- 1x Hyaluronic Serum 20ml- 1x Diamond Serum 20ml- 1x Supple Power Moisturizer 25ml                                              ', '[3_PCS_WEB]_PAKET_BERLIAN_MOISTURIZER_Meratakan_Tekstur_Kulit___Melembapkan_.jpg', 'C0010', 100),
(81, 'SOMETHINC [4 PCS] Paket Skincare Berlian with toner - Anti Aging', 502000, 'Bundle set details:Anti Aging- 1x Supple Power Toner 40ml- 1x Retinol 1% Encapsulated 20ml- 1x Diamond Serum 20ml- 1x Bakuchiol SOS Moisturizer 25ml                                       ', '[4_PCS_WEB]_PAKET_BERLIAN_TONER_Meratakan_Tekstur_Kulit_Anti_Aging.jpg', 'C0010', 100),
(82, 'SOMETHINC [4 PCS] Paket Skincare Berlian with toner - Bebas Jerawat', 422000, 'Bundle set details:Acne Free- 1x Acnedot Toner 40ml- 1x 2% BHA Salicylic Acid 20ml- 1x Diamond Serum 20ml- 1x Acnedot Moisturizer 25ml                                        ', '[4_PCS_WEB]_PAKET_BERLIAN_TONER_Meratakan_Tekstur_Kulit___Bebas_Jerawat.jpg', 'C0010', 100),
(83, 'SOMETHINC [4 PCS] Paket Skincare Berlian with toner - Brightening', 402000, 'Bundle set details:Brightening- 1x Skin Goals Toner 40ml- 1x Diamond Serum 20ml- 1x 5% Niacinamide Sabi 20 ml- 1x Skin Goals Moisturizer                                        ', '[4_PCS_WEB]_PAKET_BERLIAN_TONER_Meratakan_Tekstur_Kulit___Mencerahkan.jpg', 'C0010', 100),
(84, 'SOMETHINC [4 PCS] Paket Skincare Berlian with toner - Melembabkan', 482500, 'Bundle set details:Moisturizing- 1x Supple Power Toner 40ml-&nbsp;1x Hyaluronic Acid 20ml-&nbsp;1x Diamond Serum 20ml-&nbsp;1x Supple Power Moisturizer 25ml                                            ', '[4_PCS_WEB]_PAKET_BERLIAN_TONER_Meratakan_Tekstur_Kulit___Melembapkan_.jpg', 'C0010', 100),
(85, 'Liptint Bibir Lembap 24 Jam Kit - Non HK', 128000, 'Bundle set included:1x OMBRELLA Lip Totem Tint1x&nbsp;BEE POWER Propolis Glow Lip Serum&nbsp;Ombrella Lip Totem TintSKINCARE INFUSED LIPTINT!&nbsp;Get your fresh ombre lips like K-Idol effortlessly. With a long-lasting &amp; non-drying formulation, you can use this lip tint all day without worrying about causing chapped lips or unnatural stains. Gives instant cover even on dark lips with intense pigmentation in one swipe!&nbsp;BEE POWER ', 'WhatsApp_Image_2022-09-16_at_1.54_.15_PM_.jpeg', 'C0010', 100),
(86, 'NCT DREAM\'S Pick - Anti Aging Kit (Vol. 2)', 218000, 'NCT DREAM\'S Pick - Anti Aging Kit (Vol. 2)&nbsp;NCT DREAM\'s PICK for Signs of Aging &amp; Fine Lines!The collaboration of Somethinc x NCT DREAM Vol. 2 for #SomethincSquad to defy aging such as dark undereye, wrinkles, fine lines &amp; dull skin.Bundle Details:1x Supple Power Hyaluronic9+ Onsen Essence Toner Birthday Edition - 40ml (Toner with 48Hr Moisture Lock &amp; Hydration)1x Holygrail Multipeptide ', 'SliderNCT_AntiAging-1.jpg', 'C0010', 100),
(87, 'NCT DREAM\'S Pick - Acne & Pore Combat Kit (Vol. 2)', 238000, 'NCT DREAM\'S Pick - Acne &amp; Pore Combat Kit (Vol. 2)NCT DREAM\'s PICK for Acne &amp; Pore problems!The collaboration of Somethinc x NCT DREAM Vol. 2 for #SomethincSquad who has oily, dull, acne &amp; textured skin. Made for those who want to minimize pores appearance.&nbsp;Bundle Details:1x Glow Maker AHA BHA PHA Clarifying Treatment Toner Birthday Edition -&nbsp;100ml (Exfoliating Toner to Remove ', 'SliderNCT_AcnePore-1.jpg', 'C0010', 100),
(88, 'NCT DREAM\'S Pick - Brightening Skin Kit (Vol. 2)', 258000, 'NCT DREAM\'S Pick - Brightening Skin Kit (Vol. 2)&nbsp;NCT DREAM\'s PICK for Bright &amp; Glowing Skin like K-Idol!&nbsp;The collaboration of Somethinc x NCT DREAM Vol. 2 for #SomethincSquad to achieve a supple, glowing &amp; bright skin!&nbsp;Bundle Details:1x 5% Niacinamide Sabi Brightening Serum -&nbsp;20ml (#1 Brightening Serum)1x Alpha Squalaneoxidant Deep Cleansing Oil - 100ml (PowerfulCleanser to Remove Makeup &amp; Dirt)5 pcs PC ', 'SliderNCT_BrighteningSkin-1.jpg', 'C0010', 100),
(89, 'NCT DREAM\'S Pick - Sensitive Skin Kit (Vol 2)', 238000, 'NCT DREAM\'S Pick - Sensitive Skin Kit (Vol 2)NCT DREAM\'s PICK for Tired &amp; Sensitive skin!The collaboration of Somethinc x NCT DREAM Vol. 2 for #SomethincSquad who experience dull &amp; dry skin, frequent breakout &amp; dark undereye.&nbsp;Bundle Details :&nbsp;1x 3% Astaxanthin + Chlorelina Serum -&nbsp;20ml (Dull Skin &amp; Dark Undereye Reducer Serum)1x Game Changer Ultimate Eye Concentrate Gel -&nbsp;20ml (Light Eye ', 'SliderNCT_SensitiveSkin-1.jpg', 'C0010', 100),
(90, 'Paket Atasi Kulit Berjerawat Anti Ribet - Bakuchiol Skinpair Serum', 342000, 'Bundle Details :&nbsp;1x&nbsp;Bakuchiol Skinpair Oil Serum 20ml1x&nbsp;ACNEDOT Treatment Low pH Cleanser 100ml1x&nbsp;ACNEDOT Treatment Toner 40ml1x&nbsp;ACNEDOT Treatment Moisturizer Gel 25ml                                           ', 'IMG_3758.jpg', 'C0010', 100),
(91, 'Paket Brightening Kulit Cerah Anti Ribet', 352000, 'Bundle Details :&nbsp;Low pH Gentle Jelly Cleanser 100ml Skin Goals Glow Essence Toner 40ml 5% Niacinamide + Moisture Sabi Beet Serum 20ml Skin Goals Moisture Silk Cr&egrave;me 25ml                                  ', 'IMG_3689.jpg', 'C0010', 100),
(92, 'Paket Brightening Kulit Cerah Anti Ribet - Revive Potion', 362000, 'Bundle details &nbsp;:&nbsp; Low pH Gentle Jelly Cleanser 100ml Skin Goals Glow Essence Toner 40ml Revive Potion 3% Arbutin + Bakuchiol 20ml&nbsp;Skin Goals Moisture Silk Cr&egrave;me 25ml                                   ', 'IMG_3688.jpg', 'C0010', 100),
(93, 'Somethinc x Han So Hee - #AGEDONTCARE Skin Set', 307000, 'Somethinc x Han So Hee - #AGEDONTCARE Skin SetHAN SO HEE\'s Kit to get Supple &amp; Youthful Skin!Bundle Details :&nbsp;1 Han So Hee Photocard1 Han So Hee Greetings1 Somethinc PEPTINOL 1% Granactive Retinoid + Peptide Night Moisturizer Creme - 25ml1 Somethinc Skin Defender Bakuchiol + COQ10 Serum - 20ml1 Holyshield! Sunscreen Comfort Corrector Serum SPF 50+ PA++++&nbsp;- 15mlHow to Use Bundle ', 'AgeDontCare-1.jpg', 'C0010', 100),
(94, 'Somethinc x Han So Hee - #BRIGHTBEAUTIFULLY Skin Set', 253000, 'Somethinc x Han So Hee - #BRIGHTBEAUTIFULLY Skin SetHAN SO HEE\'s Kit for Glowing Clear Skin Goals!&nbsp;YOUR SKIN GOALS IS HERE! #BrightBeautifully Skin in 28 Days!Bundle Details :1 Han So Hee Photocard1 Han So Hee Greetings1 Somethinc SKIN GOALS VITA PROPOLIS GLOW ESSENCE TONER&nbsp;- 40ml1 Somethinc Skin Goals Moisture Silk Creme - 25ml1 Somethinc 5% Niacinamide + Moisture Sabi Beet Brightening ', 'BrightBeautifully-1.jpg', 'C0010', 100),
(95, 'Somethinc x Han So Hee - CLOUD SKIN Look Set', 332000, 'Somethinc x Han So Hee - CLOUD SKIN Look SetHAN SO HEE\'s Kit to get her Daily Makeup Look!Bundle Details :&nbsp;1 Han So Hee Photo Card1 Han So Hee Regards1 Under Control HD Blur Loose Powder - Translucent1 OMBRELLA Lip Totem Tint - Twinnie1 Alpha Squalaneoxidant Deep Cleansing Oil - 40ml1 TAMAGO Airy Blush - MollyHow to Use Bundle :&nbsp;1. Cleanse ', 'CloudSkin-1.jpg', 'C0010', 100),
(96, 'Somethinc x Han So Hee - GIRL CRUSH Look Set', 359000, 'Somethinc x Han So Hee - GIRL CRUSH Look SetHAN SO HEE\'s Kit to get the Adorable Daily Look!Bundle Details :&nbsp;1 Han So Hee Photocard1 Han So Hee Greetings1 DOLCEVITA Face Palette1 FOREVER STAY Waterproof Liquid Eyeliner1 Reset Gentle Micellar Cleansing Water- 40ml1 Fabric Lasting Tint- MelonniHow to Use Bundle :&nbsp;1. Cleanse your face from dust &amp; dirt thoroughly with Reset ', 'GirlCrush-1.jpg', 'C0010', 100),
(97, 'Exfoliate Weekly Beginner Kit (Hyaluronic9+ Serum 20 ml dan AHA BHA PHA Peeling Solution 20 ml)', 231000, 'Isi Bundle:&nbsp;Somethinc Hyaluronic9 + Advanced + B5 Serum - 20mlSomethinc AHA BHA PHA Peeling Solution - 20ml                                             ', 'IMG_2749_31.jpg', 'C0010', 100),
(98, 'Skin Solver Kulit Berminyak dan Berjerawat Kit', 307000, 'Isi Bundle :&nbsp;Somethinc 2% BHA Salicylic Acid Liquid Perfector - 20mlSomethinc Ressurect Multibiome Serum - 20mlSomethinc 60% Vita Propolis Bee Venom Glow Serum - 20ml                                     ', 'KulitBerminyakDanBerjerawat.jpg', 'C0010', 100),
(99, 'REALISTIC White Kit', 284500, 'Isi Bundle :Somethinc 10% Niacinamide + Sabi Beet Max Brightening Serum - 20mlSomethinc Ceramic Skin Saviour - 25ml                                            ', 'IMG_2755_2.jpg', 'C0010', 100),
(100, 'SOMETHINC SKIN SOLVER Bebas Breakout dan Bruntusan Kit', 178000, 'Isi Bundle:Somethinc Bakuchiol Skinpair Oil Serum - 20mlSomethinc Ressurect Multibiome Serum - 20ml                                                 ', 'IMG_2745_2.jpg', 'C0010', 100),
(101, 'SOMETHINC Repair Your Skinbarrier', 204500, 'Isi Bundle:Somethinc HYALuronic9+ Advanced + B5 Serum - 20mlSomethinc 5% Niacinamide Barrier Serum - 20ml                                               ', 'IMG_2742_2.jpg', 'C0010', 100);
INSERT INTO `product` (`id`, `title`, `price`, `description`, `thumbnail`, `product_category_id`, `stok`) VALUES
(102, 'Everyday Moist Skincare Kit', 238000, 'Isi Bundle: - SOMETHINC Supple Power Hyaluronic9+Onsen Moisture Bomb Gel 25ml - Calm Down! PHA 3% Everyday Toner 120ml                                           ', 'Packshot-Bundle_Supple_Bomb_25ml_Square-Everyday_Moist.jpg', 'C0010', 100),
(103, 'Mini Cleansing Kit', 159000, 'Isi Bundle:1. Alpha Squalaneoxidant Deep Cleansing Oil 40 ml 2. Reset Gentle Micellar Cleansing Water 40 ml 3. Omega Butter Deep Cleansing Balm 5 gr                                     ', 'SOMETHINC_Cleansing_Kit1.jpg', 'C0010', 100),
(104, 'SOMETHINC Age Don\'t Care Exclusive Bundle', 284000, 'SOMETHINC Age Don\'t Care Exclusive Bundle, &nbsp;set bundle included:&nbsp;Somethinc&nbsp; Salmon DNA + Marine Collagen Elixir 20mlSomethinc Holygrail Multipeptide Youth Elixir 20ml&nbsp;                                         ', 'SOMETHINC_Age_Dont_Care_Exclusive_Bundle.jpg', 'C0010', 100),
(105, 'SOMETHINC Trial Toner Kit', 148000, 'SOMETHINC Trial Toner Kit, &nbsp;set bundle included:SOMETHINC GLOW MAKER AHA BHA PHA Clarifying Treatment Toner 40 mlSOMETHINC SUPPLE POWER Hyaluronic9+ Onsen Essence Toner 40 ml&nbsp;                                     ', 'SOMETHINC_Trial_Toner_Kit.jpg', 'C0010', 100),
(106, 'SOMETHINC SKIN SOLVER Mata Panda dan Kulit Kusam Kit', 178000, 'SOMETHINC SKIN SOLVER Mata Panda dan Kulit Kusam Kit, &nbsp;set bundle included:- 5% Niacinamide + Moisture Sabi Beet Serum 20 ml- 3% ASTAXANTHIN + Chlorelina Serum 20 ml&nbsp;                                  ', 'SOMETHINC_SKIN_SOLVER_Mata_Panda_dan_Kulit_Kusam_Kit.jpg', 'C0010', 100),
(107, 'SOMETHINC SKIN SOLVER Kulit Cerah Bebas Jerawat dan Komedo Kit', 218000, 'SOMETHINC SKIN SOLVER Kulit Cerah Bebas Jerawat dan Komedo Kit, &nbsp;set bundle included:&nbsp;- 2% BHA Salicylic Acid Liquid Perfector 20 ml- Revive Potion 3% Arbutin + Bakuchiol 20 ml&nbsp;                                 ', 'SOMETHINC_SKIN_SOLVER_Kulit_Cerah_Bebas_Jerawat_dan_Komedo_Kit.jpg', 'C0010', 100),
(108, 'SOMETHINC SKIN SOLVER Korean Glass Skin Kit', 248000, 'SOMETHINC SKIN SOLVER Korean Glass Skin Kit, &nbsp;set bundle included:&nbsp;Lemonade Waterless Vitamin C + Ferulic + NAG 20 mlHylapore Away Solution 20 ml&nbsp;                                       ', 'SOMETHINC_SKIN_SOLVER_Korean_Glass_Skin_Kit.jpg', 'C0010', 100),
(109, 'SOMETHINC Bright Skinpair (Bakuchiol & 10% Niacinamide Sabi 20ml)', 204500, 'SOMETHINC BRIGHT SKINPAIR (Bakuchiol &amp; 10% Niacinamide Sabi 20ml), set bundle included:&nbsp;SOMETHINC Bakuchiol Skinpair Oil Serum 20mlSOMETHINC 10% Niacinamide + Moisture Sabi Beet Max Brightening Serum 20ml                                   ', 'SOMETHINC_BRIGHT_SKINPAIR_(Bakuchiol_10%_Niacinamide_Sabi_20ml).jpg', 'C0010', 100),
(110, 'SOMETHINC SKIN SOLVER Bebas dari Bekas Jerawat Kit', 228000, 'SOMETHINC SKIN SOLVER Bebas dari Bekas Jerawat KitIsi Bundle:- Dark Spot Reducer Ampoule 20 ml- Revive Potion 3% Arbutin + Bakuchiol 20 mlDark Spot Reducer AmpouleSolusi bekas jerawat menghitam, flek, dan hiperpigmentasi pada kulit. Ampoule ini diformulasikan dengan kombinasi bahan terbaik dan zat aktif yang teruji klinis, salah satunya adalah Tranexamoyl Dipeptide-23 yang bertindak sebagai double brightening agent tanpa mengiritasi kulit ', 'Bebas_dari_Bekas_Jerawat_Kit1.jpg', 'C0010', 100),
(111, 'MOMS FAVORITE Kit', 89800, 'Set included:1. Bakuchiol Skinpair Oil Serum 5 ml2. Holygrail Multipeptide 5 ml3. 10% Niacinamide Sabi Beet Serum 5 ml                                           ', 'MomsFavoriteKit.jpg', 'C0010', 100),
(112, 'MY FIRST SKINCARE ROUTINE Bundle', 113900, 'Set included:1. Low pH Gentle Jelly Cleanser 15 ml2. Reset Micellar Water 40 ml3. Hyaluronic9+ Advanced B5&nbsp; 5ml                                            ', 'MyFirstSkincareRoutine3.jpg', 'C0010', 100),
(113, 'FIX YOUR BARRIER BUNDLE', 77700, 'FIX YOUR BARRIER BUNDLE, set included:Bakuchiol Skinpair Oil Serum 5 mLHyaluronic9+ Advanced B5 5mL5% Niacinamide Barrier 5 mL&nbsp;Isi Bundle: - Bakuchiol Skinpair Oil Serum 5 ml- Hyaluronic9 + Advanced + B5 Serum 5 ml - 5% Niacinamide Barrier Serum 5 ml &nbsp;Bakuchiol Skinpair Oil Serum Serum yang menjadi alternatif retinol dari bahan natural &amp; vegan yang memiliki kemampuan merawat jerawat sehingga ', 'FixYourBarrierBundle.jpg', 'C0010', 100),
(114, 'BYE BYE KOMEDO Bundle', 147000, 'BYE BYE KOMEDO Bundle, set bunde included:Glow Maker (Mini)Jelly Cleanser (Mini)Salmon DNA 5 ml                                                ', 'ByeByeKomedo.jpg', 'C0010', 100),
(115, 'Bright Power Skin', 582000, 'Set Included:1. Criously 24K Gold Essence 20 ml2. 10% Niacinamide+Moisture Sabi Beet Max Brightening Serum 20 ml3. Glow Maker AHA BHA PHA Clarifying Treatment Toner 40 ml4. Squad Jelly Pouch5. Somethinc Ceramic Skin Saviour Moisturizer Gel 25 ml&nbsp;How To Use Criously 24K Gold EssenceHow to use it on its Own:Apply 5 - 10 drops into your palm. Lightly press your palms ', 'Somethinc__Bright_Power_Skin__Ceramic.jpg', 'C0010', 100),
(116, 'Intensive HydraSkin', 492500, 'Intensive HydraSkin&nbsp;24HR Hydration Starter Kit! Key to Healthy Skin! Basic skincare set for maximum skin hydration. Keep your skin moisturized all day long!&nbsp;Set Included:Application tips HYALuronic9+ Advanced + B5 Serum:&nbsp;Application tips Ceramic Skin Saviour:&nbsp;Application tips SUPPLE POWER Hyaluronic9+ Onsen Essence Toner:&nbsp;                     ', 'Somethinc_Intensive_Hydraskin_Kit.jpg', 'C0010', 100),
(117, 'kelpin ganteng', 15000, 'ini gambar kelpin', 'kelpin.jpg', 'C0004', 100),
(118, 'ini daniel ', 123123, 'daniel di jepang sekarang', 'dadar.jpg', 'C0001', 16),
(119, 'Game Changer Ultimate Eye Concentrate Gel', 149000, 'YOUR ULTIMATE EYE GAME CHANGER! \r\n\r\nUltimate Game Changer instantly helps correct fine lines, wrinkles, dark circles, & puffiness around the eyes area as it’s equipped with potent antioxidants from Korean Red Pine & Resurrection Stem Cells, also Powerful 6-Potent Peptides:\r\n\r\n 1. Copper tripeptide-1 (Copper Regenerating Peptide): Increases collagen & elastin production\r\n\r\n 2. Acetyl hexapeptide-8 (Botox-like effect peptide): Reduces wrinkles by up to 11%\r\n\r\n 3. Acetyl tetrapeptide-5 (Puffy Eyes Reducing Peptide): Reduces eye bag volume by up to 24.2%\r\n\r\n 4. Palmitoyl tripeptide-38 (Wrinkle filling peptide): Reduce wrinkle volume up to 21,1% in 2 months\r\n\r\n 5. Palmitoyl tripeptide-1 & Palmitoyl tetrapeptide-7 (Dark Circle Reducing Double Peptide): Combining 2 peptide to reduce panda eyes by 19%', 'SOMETHINC_Game_Changer_Ultimate_Eye_Concentrate_Gel_no_frame2.jpg', 'C0005', 54),
(120, 'GAME CHANGER Tripeptide Eye Concentrate Gel', 145000, 'BYE-BYE DARK CIRCLES & PUFFY EYES!\r\n\r\nA Game Changer that contains 3 Powerful Peptide to treat skin contour around the eyes, overcome eye fatigue such as Dark Circles, Eye Bags, Wrinkles, & Aging in the eyes due to everyday exposure to blue light. This lightweight gel texture absorbs quickly & leaves your eye area feeling soft and awaken.\r\n\r\nWith ceramic tip to give cooling & fresh sensation to the eyes.', 'Somethinc_GameChanger_Tripeptide_EyeGel_local---12.jpg', 'C0005', 44);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`) VALUES
(1, 'felix', 'felix wijaya', '0e154ed7769df5592f37586c5692ecb6'),
(2, 'geri', 'geri trisanto', '33534f06457d5f96c234dab3d6091ff7'),
(3, 'tesmd', 'mdmdmdmd', '250cf8b51c773f3f8dc8b4be867a9a02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `FKID_USER` (`id_user`),
  ADD KEY `FKCART_ITEM` (`id_barang`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `d_trans`
--
ALTER TABLE `d_trans`
  ADD PRIMARY KEY (`dt_id`);

--
-- Indexes for table `h_trans`
--
ALTER TABLE `h_trans`
  ADD PRIMARY KEY (`ht_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thumbnail` (`thumbnail`) USING HASH,
  ADD KEY `FK_KATEGORI` (`product_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `d_trans`
--
ALTER TABLE `d_trans`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `h_trans`
--
ALTER TABLE `h_trans`
  MODIFY `ht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FKCART_ITEM` FOREIGN KEY (`id_barang`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKID_USER` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_KATEGORI` FOREIGN KEY (`product_category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
