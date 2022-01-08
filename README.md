# MaNaw Store PHP SDK

### Installation

`composer require manaw-php`

### Setup Credentials

```
use Bilions\MaNaw\MaNaw;

MaNaw::config([
  'secret_key' => '12344',
]);
```

### Category

##### Get Category

```
use Bilions\MaNaw\Category;

$id = 1;
$category = Category::get([
  'page'    => 1,
  'limit'   => 10,
  'keyword' => null
]);
```

##### Create Category

```
use Bilions\MaNaw\Category;

$filePath = '/temp/image.png';

$category = Category::create([
  'name'  => 'Test Category'
  'image' => 'file::'. $filePath,
]);
```

##### Update Category

```
use Bilions\MaNaw\Category;

$id = 1;
$category = Category::update([
  'name' => 'Test Category'
], $id);
```

##### Delete Category

```
use Bilions\MaNaw\Category;

$id = 1;
$category = Category::delete($id);
```
