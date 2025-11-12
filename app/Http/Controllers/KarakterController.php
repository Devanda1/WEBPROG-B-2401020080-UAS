<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KarakterController extends Controller
{
    // Satu sumber data karakter
    private function getKarakterList()
    {
        return [
            (object)[
                'id' => '001',
                'nama' => 'Mario',
                'game' => 'Super Mario Bros',
                'jenis' => 'Plumber',
                'foto' => 'mario.jpg',
                'background' => 'mario-bg.jpg',
                'warna' => '#ff0000',
                'deskripsi' => 'Seorang tukang ledeng yang berpetualang di dunia Mushroom Kingdom.'
            ],
            (object)[
                'id' => '002',
                'nama' => 'Link(BOTW)',
                'game' => 'The Legend of Zelda',
                'jenis' => 'Hero of Hyrule',
                'foto' => 'link.jpg',
                'background' => 'zelda-bg.jpg',
                'warna' => '#00bfff',
                'deskripsi' => 'Pahlawan dari Hyrule yang bertarung melawan kejahatan Ganon.'
            ],
            (object)[
                'id' => '003',
                'nama' => 'Pikachu',
                'game' => 'Pokémon',
                'jenis' => 'Electric Pokémon',
                'foto' => 'pikachu.jpg',
                'background' => 'pikachu-bg.jpg',
                'warna' => '#FFD700',
                'deskripsi' => 'Pokémon listrik yang setia dan ceria, mampu mengeluarkan serangan petir dari pipinya.'
            ],
            (object)[
                'id' => '004',
                'nama' => 'Lara Croft',
                'game' => 'Tomb Raider',
                'jenis' => 'Arkeolog',
                'foto' => 'lara.jpg',
                'background' => 'tomb-bg.jpg',
                'warna' => '#b8860b',
                'deskripsi' => 'Arkeolog petualang yang menjelajahi reruntuhan kuno di seluruh dunia.'
            ],
            (object)[
                'id' => '005',
                'nama' => 'Phainon',
                'game' => 'Honkai: Star Rail',
                'jenis' => 'Deliverer',
                'foto' => 'phainon.jpg',
                'background' => 'phainon-bg.jpg',
                'warna' => '#ffd700',
                'deskripsi' => 'pewaris cahaya dunia dari Amphoreus, sosok tenang namun tragis yang rela mengorbankan diri demi melindungi dunia dari kehancuran.'
            ],
            (object)[
                'id' => '006',
                'nama' => 'Six',
                'game' => 'Little Nightmares',
                'jenis' => 'Survivor',
                'foto' => 'six.jpg',
                'background' => 'six-bg.jpg',
                'warna' => '#ffff66',
                'deskripsi' => 'Terjebak di kedalaman tergelap The Maw , kelaparan dan sendirian, dunia Six penuh bahaya.'
            ],
            (object)[
                'id' => '007',
                'nama' => 'Isaac Clarke',
                'game' => 'Dead Space',
                'jenis' => 'Engineer',
                'foto' => 'isaac.jpg',
                'background' => 'isaac-bg.jpg',
                'warna' => '#00ffaa',
                'deskripsi' => 'Isaac Clarke adalah mantan insinyur sistem kapal yang bekerja untuk Concordance Extraction Corporation dan memainkan peran penting dalam peristiwa seputar Markers di abad ke-26.'
            ],
            (object)[
                'id' => '008',
                'nama' => 'Destined One',
                'game' => 'Black Myth: Wukong',
                'jenis' => 'Sage Warrior',
                'foto' => 'one.jpg',
                'background' => 'one-bg.jpg',
                'warna' => '#ff6600',
                'deskripsi' => 'Seekor monyet antropomorfik dari Gunung Huaguo , ia adalah salah satu dari banyak prajurit muda yang memulai perjalanan untuk menghidupkan kembali Raja Kera legendaris Sun Wukong dengan memulihkan enam relik: Enam Indera Orang Bijak Agung (大圣六根Dàshèng Liùgēn ) yang telah dipecah Wukong setelah kekalahannya berabad-abad lalu, yang telah tersebar di seluruh wilayah Tiongkok dan India.'
            ],
            (object)[
                'id' => '009',
                'nama' => 'Ranni The Witch',
                'game' => 'Elden Ring',
                'jenis' => 'Lunar Princess',
                'foto' => 'ranni.jpg',
                'background' => 'ranni-bg.jpg',
                'warna' => '#66ccff',
                'deskripsi' => 'Penyihir misterius yang menolak takdir, mencari kebebasan di bawah cahaya bulan biru.'
            ],
            (object)[
                'id' => '010',
                'nama' => 'Olga Marie Animusphere',
                'game' => 'Fate/Grand Order',
                'jenis' => 'Chaldea Director',
                'foto' => 'olgamarie.jpg',
                'background' => 'summon-bg.jpg',
                'warna' => '#d46aff',
                'deskripsi' => 'seorang pemimpin yang tegas dan sombong namun juga tidak aman dan berhati lembut.'
            ],
            (object)[
                'id' => '011',
                'nama' => 'Ghost',
                'game' => 'Call Of Duty',
                'jenis' => 'British SAS operator',
                'foto' => 'ghost.jpg',
                'background' => 'cod-bg.jpg',
                'warna' => '#808080',
                'deskripsi' => 'Simon "Ghost" Riley adalah seorang operator SAS Inggris terkemuka yang dikenal karena balaklava bermotif tengkorak, kacamata hitam, dan headset ikoniknya'
            ],
            (object)[
                'id' => '012',
                'nama' => 'Solaire',
                'game' => 'Darksoul',
                'jenis' => 'Knight of Astora',
                'foto' => 'solaire.jpg',
                'background' => 'ds1-bg.jpg',
                'warna' => '#FFD866',
                'deskripsi' => 'seorang prajurit Undead dari tanah Astora yang mencari "mataharinya" sendiri melalui sebuah pencarian yang melibatkan ziarah pribadi dan pelayanan kepada perjanjian Warriors of Sunlight'
            ],
            (object)[
                'id' => '013',
                'nama' => 'Furina',
                'game' => 'Genshin Impact',
                'jenis' => 'Actress',
                'foto' => 'furina.jpg',
                'background' => 'fontaine-bg.jpg',
                'warna' => '#00E4FF',
                'deskripsi' => 'Sebuah wadah manusia yang memainkan peran Hydro Archon dari Fontaine selama 500 tahun, tetapi merupakan entitas yang terpisah dari Archon sejati, Focalors'
            ],
            (object)[
                'id' => '014',
                'nama' => 'The Hunter',
                'game' => 'Bloodborne',
                'jenis' => 'Beast Slayer',
                'foto' => 'thehunter.jpg',
                'background' => 'yharnam-bg.jpg',
                'warna' => '#B22222',
                'deskripsi' => 'Pemburu tanpa nama yang berjuang melawan mimpi buruk di kota Yharnam yang terkutuk.'
            ],
            (object)[
                'id' => '015',
                'nama' => 'Destiny(Anna)',
                'game' => 'Takt Op. Symphony',
                'jenis' => 'Musicart',
                'foto' => 'destiny.jpg',
                'background' => 'taktop-bg.jpg',
                'warna' => '#ff3366',
                'deskripsi' => 'Seorang gadis yang anggun. Suaranya hampir tak pernah bergetar, dan perilakunya elegan. Namun, tindakannya semata-mata didasarkan pada nilai-nilainya sendiri, dan sikapnya bisa lembut namun tegas.'
            ],
        ];
    }

    public function index()
    {
        $karakterList = $this->getKarakterList();
        return view('karakter.index', compact('karakterList'));
    }

    public function show($id)
    {
        $karakterList = $this->getKarakterList();
        $karakter = collect($karakterList)->firstWhere('id', $id);

        if (!$karakter) {
            abort(404, 'Karakter tidak ditemukan');
        }

        return view('karakter.show', compact('karakter'));
    }
}
