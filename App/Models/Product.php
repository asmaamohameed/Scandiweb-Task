<?php

namespace App\Models;

class Product extends Model
{
    /**
     * All product data (sku, name, price, type, value, etc.)
     *
     * @var array
     */
    protected array $attributes = [];

    /**
     * Mapping for type-specific value computation.
     */
    protected static function getFormatters(): array
    {
        return [
            'dvd' => function (array $data): string {
                return "Size: " .$data['size']. " MB";
            },
            'book' => function (array $data): string {
                return "Weight: " . $data['weight']. " KG";
            },
            'furniture' => function (array $data): string {
                return "Dimension: " .$data['height'] . "*" . $data['width'] . "*" . $data['length'];
            },
        ];
    }

    /**
     * Constructor.
     * When data is provided (e.g., creating a new product), compute type-specific value.
     * If no data is provided (e.g., PDO hydration), do nothing.
     */
    public function __construct(array $data = [])
    {
        if (empty($data)) {
            return;
        }
        $this->attributes = $data;
        // Normalize type.
        $this->attributes['type'] = strtolower($data['type'] ?? '');

        // Retrieve formatter mapping.
        $formatters = static::getFormatters();

        if (!isset($formatters[$this->attributes['type']])) {
            throw new \Exception("Invalid product type: " . ($data['type'] ?? ''));
        }
        $formatter = $formatters[$this->attributes['type']];
        // Compute the value.
        $this->attributes['value'] = $formatter($data);
    }

    /**
     * Magic getter to access attributes as properties.
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Magic setter to assign values to attributes.
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Returns all attributes as an associative array.
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * Save the product.
     * Only saves the columns that exist in your database.
     */
    public function save()
    {
        // Assuming your database table has columns: sku, name, price, type, and value.
        $data = [
            'sku'   => $this->attributes['sku']   ?? '',
            'name'  => $this->attributes['name']  ?? '',
            'price' => $this->attributes['price'] ?? 0,
            'type'  => $this->attributes['type']  ?? '',
            'value' => $this->attributes['value'] ?? '',
        ];

        return parent::create($data);
    }

    /**
     * Factory method.
     */
    public static function create(array $data)
    {
        $product = new static($data);
        return $product->save();
    }
}
