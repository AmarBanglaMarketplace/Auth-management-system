<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        // === Games CATEGORIES ===
        $electronics = $this->createCategory('Athletics', null, 1, 'electronics,gadgets,devices', 'categories/hwXpagFsKICuTmTBDNPSVFCOrFPqZPAWzcDWEBRG.png');
        $fashion     = $this->createCategory('Football', null, 2, 'clothing,shoes,accessories', 'categories/I5Gycoa3F23PM6AsCsaf0iryWPHqkGZMJVBys7Pd.png');
        $books       = $this->createCategory('Cricket', null, 3, 'books,novels,literature', 'categories/itvH9COLnKJH5SwliIs5g48ruDsl3wHwtP0MVEWr.png');
        $home        = $this->createCategory('Badminton', null, 4, 'books,novels,literature', 'categories/rjCWiDiobP23g2TPSe3l3eLdmppecng3rkeHIkMR.png');
        $sports      = $this->createCategory('Swimming', null, 5, 'sports,gear,equipment', 'categories/SpkbiIclmBC1Ri3QguEAxIAceP09HhOQL5tZV1nm.png');
    }

    /**
     * Create or get existing category with default values
     */
    private function createCategory($name, $parentId, $sortOrder, $keywords = '', $image = '')
    {

        return Category::firstOrCreate(
            ['category_name' => $name, 'parent_id' => $parentId],
            [
                'slug'             => Str::slug($name),
                'breadcrumb'       => $name,
                'description'      => "$name and related products",
                'meta_title'       => $name,
                'meta_description' => "Shop for $name online at best prices",
                'meta_keyword'     => $keywords,
                'image'            => $image,
                'alt_name'         => "$name Alt",
                'sort_order'       => $sortOrder,
                'status'           => '1',
                'createdBy'        => 1,
                'updatedBy'        => 1,
            ]
        );
    }
}
