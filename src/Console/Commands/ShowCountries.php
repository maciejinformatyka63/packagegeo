<?php

namespace Www\PackageGeo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ShowCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'countries:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get an array of all the countries (with UN recognition)';

    protected static $charVariants = [
        // Minuscules
        'à' => 'a',
        'â' => 'a',
        'ä' => 'a',
        'ç' => 'c',
        'é' => 'e',
        'è' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'î' => 'i',
        'ï' => 'i',
        'ô' => 'o',
        'ö' => 'o',
        'ù' => 'u',
        'û' => 'u',
        'ü' => 'u',
        'ÿ' => 'y',
        
        // Majuscules
        'À' => 'A',
        'Â' => 'A',
        'Ä' => 'A',
        'Ç' => 'C',
        'É' => 'E',
        'È' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Î' => 'I',
        'Ï' => 'I',
        'Ô' => 'O',
        'Ö' => 'O',
        'Ù' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ÿ' => 'Y'
    ];

    protected static $countries = [
        ["name" => "Afghanistan", "iso" => "AF"],
        ["name" => "Afrique du Sud", "iso" => "ZA"],
        ["name" => "Albanie", "iso" => "AL"],
        ["name" => "Algérie", "iso" => "DZ"],
        ["name" => "Allemagne", "iso" => "DE"],
        ["name" => "Andorre", "iso" => "AD"],
        ["name" => "Angola", "iso" => "AO"],
        ["name" => "Antigua-et-Barbuda", "iso" => "AG"],
        ["name" => "Arabie Saoudite", "iso" => "SA"],
        ["name" => "Argentine", "iso" => "AR"],
        ["name" => "Arménie", "iso" => "AM"],
        ["name" => "Australie", "iso" => "AU"],
        ["name" => "Autriche", "iso" => "AT"],
        ["name" => "Azerbaïdjan", "iso" => "AZ"],
        ["name" => "Bahamas", "iso" => "BS"],
        ["name" => "Bahreïn", "iso" => "BH"],
        ["name" => "Bangladesh", "iso" => "BD"],
        ["name" => "Barbade", "iso" => "BB"],
        ["name" => "Belgique", "iso" => "BE"],
        ["name" => "Belize", "iso" => "BZ"],
        ["name" => "Bénin", "iso" => "BJ"],
        ["name" => "Bhoutan", "iso" => "BT"],
        ["name" => "Biélorussie", "iso" => "BY"],
        ["name" => "Birmanie (Myanmar)", "iso" => "MM"],
        ["name" => "Bolivie", "iso" => "BO"],
        ["name" => "Bosnie-Herzégovine", "iso" => "BA"],
        ["name" => "Botswana", "iso" => "BW"],
        ["name" => "Brésil", "iso" => "BR"],
        ["name" => "Brunei", "iso" => "BN"],
        ["name" => "Bulgarie", "iso" => "BG"],
        ["name" => "Burkina Faso", "iso" => "BF"],
        ["name" => "Burundi", "iso" => "BI"],
        ["name" => "Cambodge", "iso" => "KH"],
        ["name" => "Cameroun", "iso" => "CM"],
        ["name" => "Canada", "iso" => "CA"],
        ["name" => "Cap-Vert", "iso" => "CV"],
        ["name" => "République centrafricaine", "iso" => "CF"],
        ["name" => "Chili", "iso" => "CL"],
        ["name" => "Chine", "iso" => "CN"],
        ["name" => "Chypre", "iso" => "CY"],
        ["name" => "Colombie", "iso" => "CO"],
        ["name" => "Comores", "iso" => "KM"],
        ["name" => "République du Congo", "iso" => "CG"],
        ["name" => "République démocratique du Congo", "iso" => "CD"],
        ["name" => "Corée du Nord", "iso" => "KP"],
        ["name" => "Corée du Sud", "iso" => "KR"],
        ["name" => "Costa Rica", "iso" => "CR"],
        ["name" => "Côte d'Ivoire", "iso" => "CI"],
        ["name" => "Croatie", "iso" => "HR"],
        ["name" => "Cuba", "iso" => "CU"],
        ["name" => "Danemark", "iso" => "DK"],
        ["name" => "Djibouti", "iso" => "DJ"],
        ["name" => "République dominicaine", "iso" => "DO"],
        ["name" => "Dominique", "iso" => "DM"],
        ["name" => "Égypte", "iso" => "EG"],
        ["name" => "Émirats arabes unis", "iso" => "AE"],
        ["name" => "Équateur", "iso" => "EC"],
        ["name" => "Érythrée", "iso" => "ER"],
        ["name" => "Espagne", "iso" => "ES"],
        ["name" => "Estonie", "iso" => "EE"],
        ["name" => "Eswatini", "iso" => "SZ"],
        ["name" => "États-Unis", "iso" => "US"],
        ["name" => "Éthiopie", "iso" => "ET"],
        ["name" => "Fidji", "iso" => "FJ"],
        ["name" => "Finlande", "iso" => "FI"],
        ["name" => "France", "iso" => "FR"],
        ["name" => "Gabon", "iso" => "GA"],
        ["name" => "Gambie", "iso" => "GM"],
        ["name" => "Géorgie", "iso" => "GE"],
        ["name" => "Ghana", "iso" => "GH"],
        ["name" => "Grèce", "iso" => "GR"],
        ["name" => "Grenade", "iso" => "GD"],
        ["name" => "Guatemala", "iso" => "GT"],
        ["name" => "Guinée", "iso" => "GN"],
        ["name" => "Guinée-Bissau", "iso" => "GW"],
        ["name" => "Guinée équatoriale", "iso" => "GQ"],
        ["name" => "Guyana", "iso" => "GY"],
        ["name" => "Haïti", "iso" => "HT"],
        ["name" => "Honduras", "iso" => "HN"],
        ["name" => "Hongrie", "iso" => "HU"],
        ["name" => "Inde", "iso" => "IN"],
        ["name" => "Indonésie", "iso" => "ID"],
        ["name" => "Irak", "iso" => "IQ"],
        ["name" => "Iran", "iso" => "IR"],
        ["name" => "Irlande", "iso" => "IE"],
        ["name" => "Islande", "iso" => "IS"],
        ["name" => "Israël", "iso" => "IL"],
        ["name" => "Italie", "iso" => "IT"],
        ["name" => "Jamaïque", "iso" => "JM"],
        ["name" => "Japon", "iso" => "JP"],
        ["name" => "Jordanie", "iso" => "JO"],
        ["name" => "Kazakhstan", "iso" => "KZ"],
        ["name" => "Kenya", "iso" => "KE"],
        ["name" => "Kirghizistan", "iso" => "KG"],
        ["name" => "Kiribati", "iso" => "KI"],
        ["name" => "Koweït", "iso" => "KW"],
        ["name" => "Laos", "iso" => "LA"],
        ["name" => "Lesotho", "iso" => "LS"],
        ["name" => "Lettonie", "iso" => "LV"],
        ["name" => "Liban", "iso" => "LB"],
        ["name" => "Libéria", "iso" => "LR"],
        ["name" => "Libye", "iso" => "LY"],
        ["name" => "Liechtenstein", "iso" => "LI"],
        ["name" => "Lituanie", "iso" => "LT"],
        ["name" => "Luxembourg", "iso" => "LU"],
        ["name" => "Macédoine du Nord", "iso" => "MK"],
        ["name" => "Madagascar", "iso" => "MG"],
        ["name" => "Malaisie", "iso" => "MY"],
        ["name" => "Malawi", "iso" => "MW"],
        ["name" => "Maldives", "iso" => "MV"],
        ["name" => "Mali", "iso" => "ML"],
        ["name" => "Malte", "iso" => "MT"],
        ["name" => "Maroc", "iso" => "MA"],
        ["name" => "Marshall", "iso" => "MH"],
        ["name" => "Maurice", "iso" => "MU"],
        ["name" => "Mauritanie", "iso" => "MR"],
        ["name" => "Mexique", "iso" => "MX"],
        ["name" => "Micronésie", "iso" => "FM"],
        ["name" => "Moldavie", "iso" => "MD"],
        ["name" => "Monaco", "iso" => "MC"],
        ["name" => "Mongolie", "iso" => "MN"],
        ["name" => "Monténégro", "iso" => "ME"],
        ["name" => "Mozambique", "iso" => "MZ"],
        ["name" => "Namibie", "iso" => "NA"],
        ["name" => "Nauru", "iso" => "NR"],
        ["name" => "Népal", "iso" => "NP"],
        ["name" => "Nicaragua", "iso" => "NI"],
        ["name" => "Niger", "iso" => "NE"],
        ["name" => "Nigeria", "iso" => "NG"],
        ["name" => "Norvège", "iso" => "NO"],
        ["name" => "Nouvelle-Zélande", "iso" => "NZ"],
        ["name" => "Oman", "iso" => "OM"],
        ["name" => "Ouganda", "iso" => "UG"],
        ["name" => "Ouzbékistan", "iso" => "UZ"],
        ["name" => "Pakistan", "iso" => "PK"],
        ["name" => "Palaos", "iso" => "PW"],
        ["name" => "Panama", "iso" => "PA"],
        ["name" => "Papouasie-Nouvelle-Guinée", "iso" => "PG"],
        ["name" => "Paraguay", "iso" => "PY"],
        ["name" => "Pays-Bas", "iso" => "NL"],
        ["name" => "Pérou", "iso" => "PE"],
        ["name" => "Philippines", "iso" => "PH"],
        ["name" => "Pologne", "iso" => "PL"],
        ["name" => "Portugal", "iso" => "PT"],
        ["name" => "Qatar", "iso" => "QA"],
        ["name" => "Roumanie", "iso" => "RO"],
        ["name" => "Royaume-Uni", "iso" => "GB"],
        ["name" => "Russie", "iso" => "RU"],
        ["name" => "Rwanda", "iso" => "RW"],
        ["name" => "Sainte-Lucie", "iso" => "LC"],
        ["name" => "Saint-Christophe-et-Niévès", "iso" => "KN"],
        ["name" => "Saint-Marin", "iso" => "SM"],
        ["name" => "Saint-Vincent-et-les-Grenadines", "iso" => "VC"],
        ["name" => "Salomon", "iso" => "SB"],
        ["name" => "Salvador", "iso" => "SV"],
        ["name" => "Samoa", "iso" => "WS"],
        ["name" => "Sao Tomé-et-Principe", "iso" => "ST"],
        ["name" => "Sénégal", "iso" => "SN"],
        ["name" => "Serbie", "iso" => "RS"],
        ["name" => "Seychelles", "iso" => "SC"],
        ["name" => "Sierra Leone", "iso" => "SL"],
        ["name" => "Singapour", "iso" => "SG"],
        ["name" => "Slovaquie", "iso" => "SK"],
        ["name" => "Slovénie", "iso" => "SI"],
        ["name" => "Somalie", "iso" => "SO"],
        ["name" => "Soudan", "iso" => "SD"],
        ["name" => "Soudan du Sud", "iso" => "SS"],
        ["name" => "Sri Lanka", "iso" => "LK"],
        ["name" => "Suède", "iso" => "SE"],
        ["name" => "Suisse", "iso" => "CH"],
        ["name" => "Suriname", "iso" => "SR"],
        ["name" => "Syrie", "iso" => "SY"],
        ["name" => "Tadjikistan", "iso" => "TJ"],
        ["name" => "Tanzanie", "iso" => "TZ"],
        ["name" => "Tchad", "iso" => "TD"],
        ["name" => "Tchéquie", "iso" => "CZ"],
        ["name" => "Thaïlande", "iso" => "TH"],
        ["name" => "Timor oriental", "iso" => "TL"],
        ["name" => "Togo", "iso" => "TG"],
        ["name" => "Tonga", "iso" => "TO"],
        ["name" => "Trinité-et-Tobago", "iso" => "TT"],
        ["name" => "Tunisie", "iso" => "TN"],
        ["name" => "Turkménistan", "iso" => "TM"],
        ["name" => "Turquie", "iso" => "TR"],
        ["name" => "Tuvalu", "iso" => "TV"],
        ["name" => "Ukraine", "iso" => "UA"],
        ["name" => "Uruguay", "iso" => "UY"],
        ["name" => "Vanuatu", "iso" => "VU"],
        ["name" => "Venezuela", "iso" => "VE"],
        ["name" => "Viêt Nam", "iso" => "VN"],
        ["name" => "Yémen", "iso" => "YE"],
        ["name" => "Zambie", "iso" => "ZM"],
        ["name" => "Zimbabwe", "iso" => "ZW"]
    ];

    protected static function insert() {
        foreach(self::$countries as $country) {
            DB::table('zone')->upsert(
                [
                    'type' => 'country',
                    'name' => $country['name'],
                    'slug' => strtolower(preg_replace('/\(.*\)/', "", strtr(strtr($country['name'], array(" " => "")), self::$charVariants))),
                    'ISO' => $country['iso']
                ],['id'], ['slug']);
        }
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (Schema::hasTable('zone')) {
            self::insert();
        }
        else {
            Schema::create('zone', function(Blueprint $table) {
                $table->id();
                $table->enum('type', ['country', 'department', 'region']);
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->string('ISO')->nullable()->unique();
            });
            self::insert();
        }
        
    }
}
