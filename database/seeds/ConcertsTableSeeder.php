<?php

use App\Concert;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ConcertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $images = [ 
            "https://d1csarkz8obe9u.cloudfront.net/posterpreviews/modern-glossy-music-event-poster-design-template-84d38a706368baec17981e71a5e5810d_screen.jpg?ts=1566606586",
            "https://thumbs.dreamstime.com/z/abstract-poster-event-template-fluid-shapes-composition-modern-event-poster-template-futuristic-design-posters-liquid-color-152203412.jpg",
            "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/123325792/original/1b9c99dbd3d38fc7902edf753e8705f614807270/design-an-event-poster.jpg",
            "https://i.pinimg.com/originals/d6/1c/1d/d61c1d8bb37f7225c5fa56c28ba99276.jpg",
            "https://ezellohub.com/wp-content/uploads/2020/02/poster3.jpg",
            "https://lh3.googleusercontent.com/proxy/KbCXeTp5r3uuFMEwlHxRLmyqfSbzudRfS-pMvGGEb1wdVQGzH89aIRgDi36udKYRKqf_ve4Kv2Wrx04k9Vr2AL1hcB1AEmUS7gtN33R5_D2PFsKbgxcHC4h0YDY0bmK3TlI2",
            "https://i.pinimg.com/originals/1b/01/36/1b01366952860b7a3a4f003511bbcaa8.png",
            "https://media.istockphoto.com/vectors/stand-up-comedy-night-live-show-a3-a4-poster-design-template-standup-vector-id1187066122",
            "https://cdn11.bigcommerce.com/s-ydriczk/images/stencil/590x590/products/86977/86530/sex_and_the_city_poster_buy_original_movie_posters_at_starstills__80330__76842.1394515793.jpg?c=2",
            "https://i.pinimg.com/originals/22/22/dc/2222dc9ad585bbe3fb7f958e1bce3695.jpg",
            "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/159862210/original/0f5374551e66ddc466dc4697a47e610c2afdb0bf/design-a-poster-for-any-performance-event.jpg",
            "https://images.squarespace-cdn.com/content/v1/55294647e4b043705b242393/1428802144887-D2RVFGZCJLRR8RLEXLG0/apocalyptic-theatre-poster4.jpg",
            "https://www.elegantflyer.com/wp-content/uploads/2020/10/Thumbnail_Poster-7.jpg",
            "https://i.pinimg.com/474x/f1/2c/fc/f12cfcc98411e7f710cc020803936d97--shakira-live-beirut-lebanon.jpg",
            "https://conversationsabouther.net/wp-content/uploads/2015/12/Justin-Bieber-Purpose-Live.jpg",
            "https://m.media-amazon.com/images/I/81GfnMuWnkL._AC_SL1500_.jpg",
            "https://cdn.pastemagazine.com/www/system/images/photo_albums/best-movie-posters-2016/large/moonlight-ver2-xlg.jpg?1384968217",
            "https://www.homewallmurals.co.uk/ekmps/shops/allwallpapers/images/avengers-infinity-war-61x91-5cm-movie-poster-31650-1-p.jpg",
            "https://www.posters.eu/media/catalog/product/cache/cb3faf85ecb1e071fdba48f981c86454/p/y/py_pp34589-mulan-movie-be-legendary.jpg",
            "https://cdn.shopify.com/s/files/1/1057/4964/products/naked-lunch-vintage-movie-poster-original-1-sheet-27x41-2639.jpg?v=1618357198",
            "https://m.media-amazon.com/images/M/MV5BMTg4ODkzMDQ3Nl5BMl5BanBnXkFtZTgwNTEwMTkxMDE@._V1_.jpg"
        ];
        
        Concert::create([
         'titre' => $faker->sentence(6, false),
         'slug' => $faker->slug,
         'description' => $faker->text,
         'image' => $images[0]
      ])->categories()->attach([1]);

        Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[1]
         ])->categories()->attach([1]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[2]
         ])->categories()->attach([3]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[3]
         ])->categories()->attach([4]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[4]
         ])->categories()->attach([2]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[5]
         ])->categories()->attach([2]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[6]
         ])->categories()->attach([2]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[7]
         ])->categories()->attach([4]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[8]
         ])->categories()->attach([4]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[9]
         ])->categories()->attach([4]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[10]
         ])->categories()->attach([1]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[11]
         ])->categories()->attach([1]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[12]
         ])->categories()->attach([1]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[13]
         ])->categories()->attach([3]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[14]
         ])->categories()->attach([3]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[15]
         ])->categories()->attach([3]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[16]
         ])->categories()->attach([5]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[17]
         ])->categories()->attach([5]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[18]
         ])->categories()->attach([5]);

         Concert::create([
            'titre' => $faker->sentence(6, false),
            'slug' => $faker->slug,
            'description' => $faker->text,
            'image' => $images[19]
         ])->categories()->attach([5]);

         
    }
}
