<?php

use App\Models\Area;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->foreignIdFor(Area::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        $initial_regions = [
            'North' => [
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
            'Midlands' => [
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
            'South West' => [
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
            'South East' => [
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
                'Thurrock'
            ],
            'London' => [
                'Greater London'
            ]
        ];

        foreach($initial_regions as $area => $regions) {
            $area_model = Area::firstWhere('name', $area);
            foreach($regions as $region) {
                $area_model->regions()->create(['name' => $region]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
