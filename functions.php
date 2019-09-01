<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php
	function getLocale($site_locale){
		$localeList = array (
			'af_NA' => 'Afrikaans (Namibia)',
			'af_ZA' => 'Afrikaans (South Africa)',
			'ak' => 'Akan',
			'ak_GH' => 'Akan (Ghana)',
			'sq_AL' => 'Albanian (Albania)',
			'sq_XK' => 'Albanian (Kosovo)',
			'sq_MK' => 'Albanian (Macedonia)',
			'am_ET' => 'Amharic (Ethiopia)',
			'ar_DZ' => 'Arabic (Algeria)',
			'ar_BH' => 'Arabic (Bahrain)',
			'ar_TD' => 'Arabic (Chad)',
			'ar_KM' => 'Arabic (Comoros)',
			'ar_DJ' => 'Arabic (Djibouti)',
			'ar_EG' => 'Arabic (Egypt)',
			'ar_ER' => 'Arabic (Eritrea)',
			'ar_IQ' => 'Arabic (Iraq)',
			'ar_IL' => 'Arabic (Israel)',
			'ar_JO' => 'Arabic (Jordan)',
			'ar_KW' => 'Arabic (Kuwait)',
			'ar_LB' => 'Arabic (Lebanon)',
			'ar_LY' => 'Arabic (Libya)',
			'ar_MR' => 'Arabic (Mauritania)',
			'ar_MA' => 'Arabic (Morocco)',
			'ar_OM' => 'Arabic (Oman)',
			'ar_PS' => 'Arabic (Palestinian Territories)',
			'ar_QA' => 'Arabic (Qatar)',
			'ar_SA' => 'Arabic (Saudi Arabia)',
			'ar_SO' => 'Arabic (Somalia)',
			'ar_SS' => 'Arabic (South Sudan)',
			'ar_SD' => 'Arabic (Sudan)',
			'ar_SY' => 'Arabic (Syria)',
			'ar_TN' => 'Arabic (Tunisia)',
			'ar_AE' => 'Arabic (United Arab Emirates)',
			'ar_EH' => 'Arabic (Western Sahara)',
			'ar_YE' => 'Arabic (Yemen)',
			'hy_AM' => 'Armenian (Armenia)',
			'as_IN' => 'Assamese (India)',
			'az_AZ' => 'Azerbaijani (Azerbaijan)',
			'az_Cyrl_AZ' => 'Azerbaijani (Cyrillic, Azerbaijan)',
			'az_Cyrl' => 'Azerbaijani (Cyrillic)',
			'az_Latn_AZ' => 'Azerbaijani (Latin, Azerbaijan)',
			'az_Latn' => 'Azerbaijani (Latin)',
			'bm' => 'Bambara',
			'bm_Latn_ML' => 'Bambara (Latin, Mali)',
			'bm_Latn' => 'Bambara (Latin)',
			'eu_ES' => 'Basque (Spain)',
			'be_BY' => 'Belarusian (Belarus)',
			'bn_BD' => 'Bengali (Bangladesh)',
			'bn_IN' => 'Bengali (India)',
			'bs_BA' => 'Bosnian (Bosnia & Herzegovina)',
			'bs_Cyrl_BA' => 'Bosnian (Cyrillic, Bosnia & Herzegovina)',
			'bs_Cyrl' => 'Bosnian (Cyrillic)',
			'bs_Latn_BA' => 'Bosnian (Latin, Bosnia & Herzegovina)',
			'bs_Latn' => 'Bosnian (Latin)',
			'br_FR' => 'Breton (France)',
			'bg_BG' => 'Bulgarian (Bulgaria)',
			'my' => 'Burmese',
			'my_MM' => 'Burmese (Myanmar (Burma))',
			'ca_AD' => 'Catalan (Andorra)',
			'ca_FR' => 'Catalan (France)',
			'ca_IT' => 'Catalan (Italy)',
			'ca_ES' => 'Catalan (Spain)',
			'zh' => 'Chinese',
			'zh_CN' => 'Chinese (China)',
			'zh_HK' => 'Chinese (Hong Kong SAR China)',
			'zh_MO' => 'Chinese (Macau SAR China)',
			'zh_Hans_CN' => 'Chinese (Simplified, China)',
			'zh_Hans_HK' => 'Chinese (Simplified, Hong Kong SAR China)',
			'zh_Hans_MO' => 'Chinese (Simplified, Macau SAR China)',
			'zh_Hans_SG' => 'Chinese (Simplified, Singapore)',
			'zh_Hans' => 'Chinese (Simplified)',
			'zh_SG' => 'Chinese (Singapore)',
			'zh_TW' => 'Chinese (Taiwan)',
			'zh_Hant_HK' => 'Chinese (Traditional, Hong Kong SAR China)',
			'zh_Hant_MO' => 'Chinese (Traditional, Macau SAR China)',
			'zh_Hant_TW' => 'Chinese (Traditional, Taiwan)',
			'zh_Hant' => 'Chinese (Traditional)',
			'kw' => 'Cornish',
			'kw_GB' => 'Cornish (United Kingdom)',
			'hr_BA' => 'Croatian (Bosnia & Herzegovina)',
			'hr_HR' => 'Croatian (Croatia)',
			'cs_CZ' => 'Czech (Czech Republic)',
			'da_DK' => 'Danish (Denmark)',
			'da_GL' => 'Danish (Greenland)',
			'nl_AW' => 'Dutch (Aruba)',
			'nl_BE' => 'Dutch (Belgium)',
			'nl_BQ' => 'Dutch (Caribbean Netherlands)',
			'nl_CW' => 'Dutch (Curaçao)',
			'nl_NL' => 'Dutch (Netherlands)',
			'nl_SX' => 'Dutch (Sint Maarten)',
			'nl_SR' => 'Dutch (Suriname)',
			'dz' => 'Dzongkha',
			'dz_BT' => 'Dzongkha (Bhutan)',
			'en_AS' => 'English (American Samoa)',
			'en_AI' => 'English (Anguilla)',
			'en_AG' => 'English (Antigua & Barbuda)',
			'en_AU' => 'English (Australia)',
			'en_BS' => 'English (Bahamas)',
			'en_BB' => 'English (Barbados)',
			'en_BE' => 'English (Belgium)',
			'en_BZ' => 'English (Belize)',
			'en_BM' => 'English (Bermuda)',
			'en_BW' => 'English (Botswana)',
			'en_IO' => 'English (British Indian Ocean Territory)',
			'en_VG' => 'English (British Virgin Islands)',
			'en_CM' => 'English (Cameroon)',
			'en_CA' => 'English (Canada)',
			'en_KY' => 'English (Cayman Islands)',
			'en_CX' => 'English (Christmas Island)',
			'en_CC' => 'English (Cocos (Keeling) Islands)',
			'en_CK' => 'English (Cook Islands)',
			'en_DG' => 'English (Diego Garcia)',
			'en_DM' => 'English (Dominica)',
			'en_ER' => 'English (Eritrea)',
			'en_FK' => 'English (Falkland Islands)',
			'en_FJ' => 'English (Fiji)',
			'en_GM' => 'English (Gambia)',
			'en_GH' => 'English (Ghana)',
			'en_GI' => 'English (Gibraltar)',
			'en_GD' => 'English (Grenada)',
			'en_GU' => 'English (Guam)',
			'en_GG' => 'English (Guernsey)',
			'en_GY' => 'English (Guyana)',
			'en_HK' => 'English (Hong Kong SAR China)',
			'en_IN' => 'English (India)',
			'en_IE' => 'English (Ireland)',
			'en_IM' => 'English (Isle of Man)',
			'en_JM' => 'English (Jamaica)',
			'en_JE' => 'English (Jersey)',
			'en_KE' => 'English (Kenya)',
			'en_KI' => 'English (Kiribati)',
			'en_LS' => 'English (Lesotho)',
			'en_LR' => 'English (Liberia)',
			'en_MO' => 'English (Macau SAR China)',
			'en_MG' => 'English (Madagascar)',
			'en_MW' => 'English (Malawi)',
			'en_MY' => 'English (Malaysia)',
			'en_MT' => 'English (Malta)',
			'en_MH' => 'English (Marshall Islands)',
			'en_MU' => 'English (Mauritius)',
			'en_FM' => 'English (Micronesia)',
			'en_MS' => 'English (Montserrat)',
			'en_NA' => 'English (Namibia)',
			'en_NR' => 'English (Nauru)',
			'en_NZ' => 'English (New Zealand)',
			'en_NG' => 'English (Nigeria)',
			'en_NU' => 'English (Niue)',
			'en_NF' => 'English (Norfolk Island)',
			'en_MP' => 'English (Northern Mariana Islands)',
			'en_PK' => 'English (Pakistan)',
			'en_PW' => 'English (Palau)',
			'en_PG' => 'English (Papua New Guinea)',
			'en_PH' => 'English (Philippines)',
			'en_PN' => 'English (Pitcairn Islands)',
			'en_PR' => 'English (Puerto Rico)',
			'en_WS' => 'English (Samoa)',
			'en_SC' => 'English (Seychelles)',
			'en_SL' => 'English (Sierra Leone)',
			'en_SG' => 'English (Singapore)',
			'en_SX' => 'English (Sint Maarten)',
			'en_SB' => 'English (Solomon Islands)',
			'en_ZA' => 'English (South Africa)',
			'en_SS' => 'English (South Sudan)',
			'en_SH' => 'English (St. Helena)',
			'en_KN' => 'English (St. Kitts & Nevis)',
			'en_LC' => 'English (St. Lucia)',
			'en_VC' => 'English (St. Vincent & Grenadines)',
			'en_SD' => 'English (Sudan)',
			'en_SZ' => 'English (Swaziland)',
			'en_TZ' => 'English (Tanzania)',
			'en_TK' => 'English (Tokelau)',
			'en_TT' => 'English (Trinidad & Tobago)',
			'en_TC' => 'English (Turks & Caicos Islands)',
			'en_TV' => 'English (Tuvalu)',
			'en_UM' => 'English (U.S. Outlying Islands)',
			'en_VI' => 'English (U.S. Virgin Islands)',
			'en_UG' => 'English (Uganda)',
			'en_GB' => 'English (United Kingdom)',
			'en_US' => 'English (United States)',
			'en_VU' => 'English (Vanuatu)',
			'en_ZM' => 'English (Zambia)',
			'en_ZW' => 'English (Zimbabwe)',
			'et_EE' => 'Estonian (Estonia)',
			'ee' => 'Ewe',
			'ee_GH' => 'Ewe (Ghana)',
			'ee_TG' => 'Ewe (Togo)',
			'fo_FO' => 'Faroese (Faroe Islands)',
			'fi_FI' => 'Finnish (Finland)',
			'fr_DZ' => 'French (Algeria)',
			'fr_BE' => 'French (Belgium)',
			'fr_BJ' => 'French (Benin)',
			'fr_BF' => 'French (Burkina Faso)',
			'fr_BI' => 'French (Burundi)',
			'fr_CM' => 'French (Cameroon)',
			'fr_CA' => 'French (Canada)',
			'fr_CF' => 'French (Central African Republic)',
			'fr_TD' => 'French (Chad)',
			'fr_KM' => 'French (Comoros)',
			'fr_CG' => 'French (Congo - Brazzaville)',
			'fr_CD' => 'French (Congo - Kinshasa)',
			'fr_CI' => 'French (Côte d’Ivoire)',
			'fr_DJ' => 'French (Djibouti)',
			'fr_GQ' => 'French (Equatorial Guinea)',
			'fr_FR' => 'French (France)',
			'fr_GF' => 'French (French Guiana)',
			'fr_PF' => 'French (French Polynesia)',
			'fr_GA' => 'French (Gabon)',
			'fr_GP' => 'French (Guadeloupe)',
			'fr_GN' => 'French (Guinea)',
			'fr_HT' => 'French (Haiti)',
			'fr_LU' => 'French (Luxembourg)',
			'fr_MG' => 'French (Madagascar)',
			'fr_ML' => 'French (Mali)',
			'fr_MQ' => 'French (Martinique)',
			'fr_MR' => 'French (Mauritania)',
			'fr_MU' => 'French (Mauritius)',
			'fr_YT' => 'French (Mayotte)',
			'fr_MC' => 'French (Monaco)',
			'fr_MA' => 'French (Morocco)',
			'fr_NC' => 'French (New Caledonia)',
			'fr_NE' => 'French (Niger)',
			'fr_RE' => 'French (Réunion)',
			'fr_SN' => 'French (Senegal)',
			'fr_SC' => 'French (Seychelles)',
			'fr_BL' => 'French (St. Barthélemy)',
			'fr_MF' => 'French (St. Martin)',
			'fr_PM' => 'French (St. Pierre & Miquelon)',
			'fr_CH' => 'French (Switzerland)',
			'fr_SY' => 'French (Syria)',
			'fr_TG' => 'French (Togo)',
			'fr_TN' => 'French (Tunisia)',
			'fr_VU' => 'French (Vanuatu)',
			'fr_WF' => 'French (Wallis & Futuna)',
			'ff' => 'Fulah',
			'ff_CM' => 'Fulah (Cameroon)',
			'ff_GN' => 'Fulah (Guinea)',
			'ff_MR' => 'Fulah (Mauritania)',
			'ff_SN' => 'Fulah (Senegal)',
			'gl_ES' => 'Galician (Spain)',
			'lg' => 'Ganda',
			'lg_UG' => 'Ganda (Uganda)',
			'ka_GE' => 'Georgian (Georgia)',
			'de_AT' => 'German (Austria)',
			'de_BE' => 'German (Belgium)',
			'de_DE' => 'German (Germany)',
			'de_LI' => 'German (Liechtenstein)',
			'de_LU' => 'German (Luxembourg)',
			'de_CH' => 'German (Switzerland)',
			'el_CY' => 'Greek (Cyprus)',
			'el_GR' => 'Greek (Greece)',
			'gu_IN' => 'Gujarati (India)',
			'ha' => 'Hausa',
			'ha_GH' => 'Hausa (Ghana)',
			'ha_Latn_GH' => 'Hausa (Latin, Ghana)',
			'ha_Latn_NE' => 'Hausa (Latin, Niger)',
			'ha_Latn_NG' => 'Hausa (Latin, Nigeria)',
			'ha_Latn' => 'Hausa (Latin)',
			'ha_NE' => 'Hausa (Niger)',
			'ha_NG' => 'Hausa (Nigeria)',
			'he_IL' => 'Hebrew (Israel)',
			'hi_IN' => 'Hindi (India)',
			'hu_HU' => 'Hungarian (Hungary)',
			'is_IS' => 'Icelandic (Iceland)',
			'sq' => 'Icyalubaniya',
			'ar' => 'Icyarabu',
			'as' => 'Icyasamizi',
			'es' => 'Icyesipanyolo',
			'eo' => 'Icyesiperanto',
			'et' => 'Icyesitoniya',
			'en' => 'Icyongereza',
			'en_TO' => 'Icyongereza (Igitonga)',
			'en_RW' => 'Icyongereza (Rwanda)',
			'ig' => 'Igbo',
			'ig_NG' => 'Igbo (Nigeria)',
			'cs' => 'Igiceke',
			'fr' => 'Igifaransa',
			'fr_RW' => 'Igifaransa (Rwanda)',
			'fi' => 'Igifinilande',
			'fy' => 'Igifiriziyani',
			'he' => 'Igiheburayo',
			'hi' => 'Igihindi',
			'hu' => 'Igihongiriya',
			'km' => 'Igikambodiya',
			'kn' => 'Igikanada',
			'ca' => 'Igikatalani',
			'ko' => 'Igikoreya',
			'hr' => 'Igikorowasiya',
			'pl' => 'Igipolone',
			'pt' => 'Igiporutugali',
			'pa' => 'Igipunjabi',
			'sr' => 'Igiseribe',
			'is' => 'Igisilande',
			'sk' => 'Igisilovaki',
			'so' => 'Igisomali',
			'sv' => 'Igisuweduwa',
			'sw' => 'Igiswahili',
			'it' => 'Igitaliyani',
			'ta' => 'Igitamili',
			'th' => 'Igitayi',
			'te' => 'Igitelugu',
			'tr' => 'Igiturukiya',
			'eu' => 'Ikibasiki',
			'be' => 'Ikibelarusiya',
			'bn' => 'Ikibengali',
			'de' => 'Ikidage',
			'da' => 'Ikidaninwa',
			'gl' => 'Ikigalisiya',
			'cy' => 'Ikigaluwa',
			'gd' => 'Ikigaluwa cy’Igisweduwa',
			'el' => 'Ikigereki',
			'lo' => 'Ikilawotiyani',
			'lt' => 'Ikilituwaniya',
			'ml' => 'Ikimalayalami',
			'ms' => 'Ikimalayi',
			'mt' => 'Ikimaliteze',
			'mr' => 'Ikimarati',
			'mk' => 'Ikimasedoniyani',
			'mn' => 'Ikimongoli',
			'ne' => 'Ikinepali',
			'nl' => 'Ikinerilande',
			'no' => 'Ikinoruveji',
			'af' => 'Ikinyafurikaneri',
			'lv' => 'Ikinyaletoviyani',
			'ro' => 'Ikinyarumaniya',
			'hy' => 'Ikinyarumeniya',
			'sl' => 'Ikinyasiloveniya',
			'vi' => 'Ikinyaviyetinamu',
			'uk' => 'Ikinyayukereni',
			'id' => 'Ikinyendoziya',
			'ga' => 'Ikirilandi',
			'ru' => 'Ikirusiya',
			'ug' => 'Ikiwiguri',
			'ja' => 'Ikiyapani',
			'ln' => 'Ilingala',
			'ps' => 'Impashito',
			'id_ID' => 'Indonesian (Indonesia)',
			'ky' => 'Inkerigizi',
			'am' => 'Inyamuhariki',
			'ti' => 'Inyatigirinya',
			'az' => 'Inyazeribayijani',
			'br' => 'Inyebiritoni',
			'bs' => 'Inyebosiniya',
			'fo' => 'Inyefaroyizi',
			'gu' => 'Inyegujarati',
			'ka' => 'Inyejeworujiya',
			'nn' => 'Inyenoruveji (Nyonorusiki)',
			'fa' => 'Inyeperisi',
			'sh' => 'Inyeseribiya na Korowasiya',
			'si' => 'Inyesimpaleze',
			'yi' => 'Inyeyidishi',
			'ur' => 'Inyeyurudu',
			'uz' => 'Inyeyuzubeki',
			'zu' => 'Inyezulu',
			'or' => 'Inyoriya',
			'ga_IE' => 'Irish (Ireland)',
			'it_IT' => 'Italian (Italy)',
			'it_SM' => 'Italian (San Marino)',
			'it_CH' => 'Italian (Switzerland)',
			'ja_JP' => 'Japanese (Japan)',
			'kl' => 'Kalaallisut',
			'kl_GL' => 'Kalaallisut (Greenland)',
			'kn_IN' => 'Kannada (India)',
			'ks' => 'Kashmiri',
			'ks_Arab_IN' => 'Kashmiri (Arabic, India)',
			'ks_Arab' => 'Kashmiri (Arabic)',
			'ks_IN' => 'Kashmiri (India)',
			'kk' => 'Kazakh',
			'kk_Cyrl_KZ' => 'Kazakh (Cyrillic, Kazakhstan)',
			'kk_Cyrl' => 'Kazakh (Cyrillic)',
			'kk_KZ' => 'Kazakh (Kazakhstan)',
			'km_KH' => 'Khmer (Cambodia)',
			'ki' => 'Kikuyu',
			'ki_KE' => 'Kikuyu (Kenya)',
			'rw' => 'Kinyarwanda',
			'rw_RW' => 'Kinyarwanda (Rwanda)',
			'ko_KP' => 'Korean (North Korea)',
			'ko_KR' => 'Korean (South Korea)',
			'ky_Cyrl_KG' => 'Kyrgyz (Cyrillic, Kyrgyzstan)',
			'ky_Cyrl' => 'Kyrgyz (Cyrillic)',
			'ky_KG' => 'Kyrgyz (Kyrgyzstan)',
			'lo_LA' => 'Lao (Laos)',
			'lv_LV' => 'Latvian (Latvia)',
			'ln_AO' => 'Lingala (Angola)',
			'ln_CF' => 'Lingala (Central African Republic)',
			'ln_CG' => 'Lingala (Congo - Brazzaville)',
			'ln_CD' => 'Lingala (Congo - Kinshasa)',
			'lt_LT' => 'Lithuanian (Lithuania)',
			'lu' => 'Luba-Katanga',
			'lu_CD' => 'Luba-Katanga (Congo - Kinshasa)',
			'lb' => 'Luxembourgish',
			'lb_LU' => 'Luxembourgish (Luxembourg)',
			'mk_MK' => 'Macedonian (Macedonia)',
			'mg' => 'Malagasy',
			'mg_MG' => 'Malagasy (Madagascar)',
			'ms_BN' => 'Malay (Brunei)',
			'ms_Latn_BN' => 'Malay (Latin, Brunei)',
			'ms_Latn_MY' => 'Malay (Latin, Malaysia)',
			'ms_Latn_SG' => 'Malay (Latin, Singapore)',
			'ms_Latn' => 'Malay (Latin)',
			'ms_MY' => 'Malay (Malaysia)',
			'ms_SG' => 'Malay (Singapore)',
			'ml_IN' => 'Malayalam (India)',
			'mt_MT' => 'Maltese (Malta)',
			'gv' => 'Manx',
			'gv_IM' => 'Manx (Isle of Man)',
			'mr_IN' => 'Marathi (India)',
			'mn_Cyrl_MN' => 'Mongolian (Cyrillic, Mongolia)',
			'mn_Cyrl' => 'Mongolian (Cyrillic)',
			'mn_MN' => 'Mongolian (Mongolia)',
			'ne_IN' => 'Nepali (India)',
			'ne_NP' => 'Nepali (Nepal)',
			'nd' => 'North Ndebele',
			'nd_ZW' => 'North Ndebele (Zimbabwe)',
			'se' => 'Northern Sami',
			'se_FI' => 'Northern Sami (Finland)',
			'se_NO' => 'Northern Sami (Norway)',
			'se_SE' => 'Northern Sami (Sweden)',
			'no_NO' => 'Norwegian (Norway)',
			'nb' => 'Norwegian Bokmål',
			'nb_NO' => 'Norwegian Bokmål (Norway)',
			'nb_SJ' => 'Norwegian Bokmål (Svalbard & Jan Mayen)',
			'nn_NO' => 'Norwegian Nynorsk (Norway)',
			'or_IN' => 'Oriya (India)',
			'om' => 'Oromo',
			'om_ET' => 'Oromo (Ethiopia)',
			'om_KE' => 'Oromo (Kenya)',
			'os' => 'Ossetic',
			'os_GE' => 'Ossetic (Georgia)',
			'os_RU' => 'Ossetic (Russia)',
			'ps_AF' => 'Pashto (Afghanistan)',
			'fa_AF' => 'Persian (Afghanistan)',
			'fa_IR' => 'Persian (Iran)',
			'pl_PL' => 'Polish (Poland)',
			'pt_AO' => 'Portuguese (Angola)',
			'pt_BR' => 'Portuguese (Brazil)',
			'pt_CV' => 'Portuguese (Cape Verde)',
			'pt_GW' => 'Portuguese (Guinea-Bissau)',
			'pt_MO' => 'Portuguese (Macau SAR China)',
			'pt_MZ' => 'Portuguese (Mozambique)',
			'pt_PT' => 'Portuguese (Portugal)',
			'pt_ST' => 'Portuguese (São Tomé & Príncipe)',
			'pt_TL' => 'Portuguese (Timor-Leste)',
			'pa_Arab_PK' => 'Punjabi (Arabic, Pakistan)',
			'pa_Arab' => 'Punjabi (Arabic)',
			'pa_Guru_IN' => 'Punjabi (Gurmukhi, India)',
			'pa_Guru' => 'Punjabi (Gurmukhi)',
			'pa_IN' => 'Punjabi (India)',
			'pa_PK' => 'Punjabi (Pakistan)',
			'qu' => 'Quechua',
			'qu_BO' => 'Quechua (Bolivia)',
			'qu_EC' => 'Quechua (Ecuador)',
			'qu_PE' => 'Quechua (Peru)',
			'ro_MD' => 'Romanian (Moldova)',
			'ro_RO' => 'Romanian (Romania)',
			'rm' => 'Romansh',
			'rm_CH' => 'Romansh (Switzerland)',
			'rn' => 'Rundi',
			'rn_BI' => 'Rundi (Burundi)',
			'ru_BY' => 'Russian (Belarus)',
			'ru_KZ' => 'Russian (Kazakhstan)',
			'ru_KG' => 'Russian (Kyrgyzstan)',
			'ru_MD' => 'Russian (Moldova)',
			'ru_RU' => 'Russian (Russia)',
			'ru_UA' => 'Russian (Ukraine)',
			'sg' => 'Sango',
			'sg_CF' => 'Sango (Central African Republic)',
			'gd_GB' => 'Scottish Gaelic (United Kingdom)',
			'sr_BA' => 'Serbian (Bosnia & Herzegovina)',
			'sr_Cyrl_BA' => 'Serbian (Cyrillic, Bosnia & Herzegovina)',
			'sr_Cyrl_XK' => 'Serbian (Cyrillic, Kosovo)',
			'sr_Cyrl_ME' => 'Serbian (Cyrillic, Montenegro)',
			'sr_Cyrl_RS' => 'Serbian (Cyrillic, Serbia)',
			'sr_Cyrl' => 'Serbian (Cyrillic)',
			'sr_XK' => 'Serbian (Kosovo)',
			'sr_Latn_BA' => 'Serbian (Latin, Bosnia & Herzegovina)',
			'sr_Latn_XK' => 'Serbian (Latin, Kosovo)',
			'sr_Latn_ME' => 'Serbian (Latin, Montenegro)',
			'sr_Latn_RS' => 'Serbian (Latin, Serbia)',
			'sr_Latn' => 'Serbian (Latin)',
			'sr_ME' => 'Serbian (Montenegro)',
			'sr_RS' => 'Serbian (Serbia)',
			'sh_BA' => 'Serbo-Croatian (Bosnia & Herzegovina)',
			'sn' => 'Shona',
			'sn_ZW' => 'Shona (Zimbabwe)',
			'ii' => 'Sichuan Yi',
			'ii_CN' => 'Sichuan Yi (China)',
			'si_LK' => 'Sinhala (Sri Lanka)',
			'sk_SK' => 'Slovak (Slovakia)',
			'sl_SI' => 'Slovenian (Slovenia)',
			'so_DJ' => 'Somali (Djibouti)',
			'so_ET' => 'Somali (Ethiopia)',
			'so_KE' => 'Somali (Kenya)',
			'so_SO' => 'Somali (Somalia)',
			'es_AR' => 'Spanish (Argentina)',
			'es_BO' => 'Spanish (Bolivia)',
			'es_IC' => 'Spanish (Canary Islands)',
			'es_EA' => 'Spanish (Ceuta & Melilla)',
			'es_CL' => 'Spanish (Chile)',
			'es_CO' => 'Spanish (Colombia)',
			'es_CR' => 'Spanish (Costa Rica)',
			'es_CU' => 'Spanish (Cuba)',
			'es_DO' => 'Spanish (Dominican Republic)',
			'es_EC' => 'Spanish (Ecuador)',
			'es_SV' => 'Spanish (El Salvador)',
			'es_GQ' => 'Spanish (Equatorial Guinea)',
			'es_GT' => 'Spanish (Guatemala)',
			'es_HN' => 'Spanish (Honduras)',
			'es_MX' => 'Spanish (Mexico)',
			'es_NI' => 'Spanish (Nicaragua)',
			'es_PA' => 'Spanish (Panama)',
			'es_PY' => 'Spanish (Paraguay)',
			'es_PE' => 'Spanish (Peru)',
			'es_PH' => 'Spanish (Philippines)',
			'es_PR' => 'Spanish (Puerto Rico)',
			'es_ES' => 'Spanish (Spain)',
			'es_US' => 'Spanish (United States)',
			'es_UY' => 'Spanish (Uruguay)',
			'es_VE' => 'Spanish (Venezuela)',
			'sw_KE' => 'Swahili (Kenya)',
			'sw_TZ' => 'Swahili (Tanzania)',
			'sw_UG' => 'Swahili (Uganda)',
			'sv_AX' => 'Swedish (Åland Islands)',
			'sv_FI' => 'Swedish (Finland)',
			'sv_SE' => 'Swedish (Sweden)',
			'tl' => 'Tagalog',
			'tl_PH' => 'Tagalog (Philippines)',
			'ta_IN' => 'Tamil (India)',
			'ta_MY' => 'Tamil (Malaysia)',
			'ta_SG' => 'Tamil (Singapore)',
			'ta_LK' => 'Tamil (Sri Lanka)',
			'te_IN' => 'Telugu (India)',
			'th_TH' => 'Thai (Thailand)',
			'bo' => 'Tibetan',
			'bo_CN' => 'Tibetan (China)',
			'bo_IN' => 'Tibetan (India)',
			'ti_ER' => 'Tigrinya (Eritrea)',
			'ti_ET' => 'Tigrinya (Ethiopia)',
			'to' => 'Tongan',
			'to_TO' => 'Tongan (Tonga)',
			'tr_CY' => 'Turkish (Cyprus)',
			'tr_TR' => 'Turkish (Turkey)',
			'uk_UA' => 'Ukrainian (Ukraine)',
			'ur_IN' => 'Urdu (India)',
			'ur_PK' => 'Urdu (Pakistan)',
			'bg' => 'Urunyabuligariya',
			'ug_Arab_CN' => 'Uyghur (Arabic, China)',
			'ug_Arab' => 'Uyghur (Arabic)',
			'ug_CN' => 'Uyghur (China)',
			'uz_AF' => 'Uzbek (Afghanistan)',
			'uz_Arab_AF' => 'Uzbek (Arabic, Afghanistan)',
			'uz_Arab' => 'Uzbek (Arabic)',
			'uz_Cyrl_UZ' => 'Uzbek (Cyrillic, Uzbekistan)',
			'uz_Cyrl' => 'Uzbek (Cyrillic)',
			'uz_Latn_UZ' => 'Uzbek (Latin, Uzbekistan)',
			'uz_Latn' => 'Uzbek (Latin)',
			'uz_UZ' => 'Uzbek (Uzbekistan)',
			'vi_VN' => 'Vietnamese (Vietnam)',
			'cy_GB' => 'Welsh (United Kingdom)',
			'fy_NL' => 'Western Frisian (Netherlands)',
			'yo' => 'Yoruba',
			'yo_BJ' => 'Yoruba (Benin)',
			'yo_NG' => 'Yoruba (Nigeria)',
			'zu_ZA' => 'Zulu (South Africa)',
		  );

		$data = '';
		foreach ($localeList as $localeKey => $localeValue) {
			$selected = ($localeKey == $site_locale) ? ' selected="selected"' : '';
			$data .= '<option value="' . $localeKey . '"' . $selected . '>' . $localeValue . '</option>';
		}
		return $data;
	}

	function getTimezones($dtz){
		$data = '';
		$tzone = DateTimeZone::listIdentifiers();
		foreach ($tzone as $zone) {
			$selected = ($zone == $dtz) ? ' selected="selected"' : '';
			$data .= '<option value="' . $zone . '"' . $selected . '>' . $zone . '</option>';
		}
		return $data;
	}

	function getChecked($row, $status){
		if ($row == $status) {
			echo "checked=\"checked\"";
		}
	}
  
	function getSelected($row, $status){
		if ($row == $status) {
			echo "selected";
		}
	}

	function userStatus($status){
		switch ($status) {
			case 'y':
				return 'Ativo';
			break;
			case 'n':
				return 'Inativo';
			break;
			case 't':
				return 'Pendente';
			break;
			case 'b':
				return 'Banido';
			break;
		}
	}

	function periodText($period, $plural = false){
		switch ($period) {
			case 'D':
				return ($plural) ? 'Dias' : 'Dia';
			break;
			case 'S':
				return ($plural) ? 'Semanas' : 'Semana';
			break;
			case 'M':
				return ($plural) ? 'Meses' : 'Mês';
			break;
			case 'A':
				return ($plural) ? 'Anos' : 'Ano';
			break;
		}
	}

	function calculateDays($period, $days, $date = null){
		if($date == null){
			$date = date('Y-m-d H:i:s');
		}

		switch($period) {
		case "D" :
			$diff = $days;
		break;
		case "S" :
			$diff = $days * 7;
		break;
		case "M" :
			$diff = $days * 30;
		break;
		case "A" :
			$diff = $days * 365;
		break;
		}
		return date("Y-m-d H:i:s", strtotime($date . + $diff . " days"));
	}

	function getTemplates($dir, $site){
		$getDir = dir($dir);
		while (false !== ($templDir = $getDir->read())) {
			if ($templDir != "." && $templDir != ".." && $templDir != "index.php") {
				$selected = ($site == $templDir) ? " selected=\"selected\"" : "";
				echo "<option value=\"{$templDir}\"{$selected}>{$templDir}</option>\n";
			}
		}
		$getDir->close();
	}


	function scandir_by_mtime($folder) {
		$dircontent = scandir($folder);
		$arr = array();
		foreach($dircontent as $filename) {
		  if ($filename != '.' && $filename != '..' && $filename != '.htaccess') {
			if (filemtime($folder.'/'.$filename) === false) return false;
			$dat = date("YmdHis", filemtime($folder.'/'.$filename));
			$arr[$dat] = $filename;
		  }
		}
		if (!ksort($arr)) return false;
		return $arr;
	  }

	  function menuAdminActive($param = array()){
		$data = explode('/', $_SERVER['PATH_INFO']); 
		if(isset($data[2])){
			if (in_array($data[2], $param)) { 
				echo "selected";
			}
		}
	  }


	  function number_format_short($n, $precision = 1) {
		if ($n < 900) {
			// 0 - 900
			$n_format = number_format($n, $precision);
			$suffix = '';
		} else if ($n < 900000) {
			// 0.9k-850k
			$n_format = number_format($n / 1000, $precision);
			$suffix = 'K';
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
		}
	  // Remova zeros desnecessários após o decimal. "1.0" -> "1"; "1.00" -> "1"
	  // Intencionalmente não afeta parciais, ex "1.50" -> "1.50"
		if ( $precision > 0 ) {
			$dotzero = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}
		return $n_format . $suffix;
	}


	function time_elapsed_string($ptime){
		$etime = time() - $ptime;

		if ($etime < 1){
			return '0 segundos';
		}

		$a = array( 
			365 * 24 * 60 * 60  =>  'ano',
			30 * 24 * 60 * 60  =>  'mês',
			24 * 60 * 60  =>  'dia',
			60 * 60  =>  'hora',
			60  =>  'minuto',
			1  =>  'segundo'
		);

		$a_plural = array(
			'ano'   => 'anos',
			'mês'  => 'meses',
			'dia'    => 'dias',
			'hora'   => 'horas',
			'minuto' => 'minutos',
			'segundo' => 'segundos'
		);

		foreach ($a as $secs => $str){
			$d = $etime / $secs;
			if ($d >= 1){
				$r = round($d);
				return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' atrás';
			}
		}
	}

	function pagination($totalResults, $resultsPerPage, $currentPage, $link, $maxlinks = 4, $width = null){
		if($totalResults > $resultsPerPage){
			$paginas = ceil($totalResults/$resultsPerPage);
				echo '<nav aria-label="Page navigation">';
			if($width){
				echo '<ul class="pagination" style="width:'.$width.'">';
			}else{
				echo '<ul class="pagination">';
			}
			echo '<li class="page-item">
					<a class="page-link" href="'.$link.'1" aria-label="Previous" title="Primeira Página">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Primeira Página</span>
					</a>
				</li>';
			for($i = $currentPage - $maxlinks; $i <= $currentPage - 1; $i++){
				if($i >= 1){
					echo '<li class="page-item"><a class="page-link" href="'.$link.$i.'">'.$i.'</a></li>';
				}
			}
			echo '<li class="page-item active"><a class="page-link" href="#">'.$currentPage.'<span class="sr-only">(current)</span></a></li>';
			for($i = $currentPage + 1; $i <= $currentPage + $maxlinks; $i++){
				if($i <= $paginas){
					echo '<li class="page-item"><a class="page-link" href="'.$link.$i.'">'.$i.'</a></li>';
				}
			}
			echo '<li class="page-item">
					<a class="page-link" href="'.$link.$paginas.'" aria-label="Next" title="Última Página">
						<span aria-hidden="true">&raquo;</span>
						<span class="sr-only">Última Página</span>
					</a>
				</li>';
			echo '</ul>';
			echo '</nav>';
		}
	}
	
?>