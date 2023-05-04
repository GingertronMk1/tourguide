<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initial_regions = [
            Area::SYSTEM_NORTH => [
                'Blackburn with Darwen',
                'Blackpool',
                'Bolton',
                'Bury',
                'Cheshire',
                'Cumbria',
                'Halton',
                'Knowsley',
                'Lancashire',
                'Liverpool',
                'Manchester',
                'Oldham',
                'Rochdale',
                'Salford',
                'Sefton',
                'St Helens',
                'Stockport',
                'Tameside',
                'Trafford',
                'Warrington',
                'Wigan',
                'Wirral',
                'Darlington',
                'Durham',
                'Gateshead',
                'Hartlepool',
                'Middlesbrough',
                'Newcastle upon Tyne',
                'North Tyneside',
                'Northumberland',
                'Redcar & Cleveland',
                'South Tyneside',
                'Stockton-on-Tees',
                'Sunderland',
                'Barnsley',
                'Bradford',
                'Calderdale',
                'Doncaster',
                'East Riding of Yorkshire',
                'Kingston upon Hull',
                'Kirklees',
                'Leeds',
                'North East Lincolnshire',
                'North Lincolnshire',
                'North Yorkshire',
                'Rotherham',
                'Sheffield',
                'Wakefield',
                'York',
            ],
            Area::SYSTEM_MIDLANDS => [
                'Birmingham',
                'Coventry',
                'Dudley',
                'Herefordshire',
                'Sandwell',
                'Shropshire',
                'Solihull',
                'Staffordshire',
                'Stoke-on-Trent',
                'Telford & Wrekin',
                'Walsall',
                'Warwickshire',
                'Wolverhampton',
                'Worcestershire',
                'Derby',
                'Derbyshire',
                'Leicester',
                'Leicestershire',
                'Lincolnshire (excluding N & NE Lincolnshire)',
                'Northamptonshire',
                'Nottingham',
                'Nottinghamshire',
                'Rutland',
            ],
            Area::SYSTEM_SOUTH_WEST => [
                'Bath & NE Somerset',
                'North Somerset',
                'Bournemouth',
                'Plymouth',
                'Bristol',
                'Poole',
                'Cornwall',
                'Portsmouth',
                'Devon',
                'Southampton',
                'Dorset',
                'Somerset',
                'Gloucestershire',
                'South Gloucestershire',
                'Hampshire',
                'Swindon',
                'Isles of Scilly',
                'Torbay',
                'Isle of Wight',
                'Wiltshire',
            ],
            Area::SYSTEM_SOUTH_EAST => [
                'Oxfordshire',
                'Bracknell Forest',
                'Reading',
                'Brighton and Hove Slough',
                'Surrey',
                'Buckinghamshire',
                'East Sussex',
                'West Berkshire',
                'Kent',
                'West Sussex',
                'Medway',
                'Windsor & Maidenhead',
                'Milton Keynes',
                'Wokingham',
                'Bedfordshire',
                'Cambridgeshire',
                'Essex',
                'Hertfordshire',
                'Luton',
                'Norfolk',
                'Peterborough',
                'Southend-on-Sea',
                'Suffolk',
                'Thurrock',
            ],
            Area::SYSTEM_LONDON => [
                'Greater London',
            ],
        ];

        foreach ($initial_regions as $area => $regions) {
            $area_model = Area::getSystemType($area);
            if ($area_model) {
                foreach ($regions as $region) {
                    $area_model->regions()->create(['name' => $region]);
                }
            } else {
                echo "No area found for {$area}\n";
            }
        }

    }
}
