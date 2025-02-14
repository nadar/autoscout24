<?php

namespace Indielab\AutoScout24;

use Indielab\AutoScout24\Base\Query;

/**
 * Vehicle Query Class.
 *
 * @author Basil Suter <basil@nadar.io>
 */
class VehicleQuery extends Query
{
    private array $_where = [];

    /**
     * Filters the query using the specified parameters.
     *
     * @param array $args An associative array where keys are field names and values are the desired filter values.
     * @return VehicleQuery
     */
    public function where(array $args): VehicleQuery
    {
        foreach ($args as $key => $value) {
            $this->_where[$key] = $value;
        }

        return $this;
    }

    /**
     *
     * @param integer $typeId Integer values with types, avialable list:
     * - 10: Personenwagen
     * - 20: Leichte Nutzfahrzeuge
     *
     * @return VehicleQuery
     */
    public function setVehicleTypeId(int $typeId): VehicleQuery
    {
        return $this->where(['vehtyp' => $typeId]);
    }
    
    /**
     *
     * @param string $type Sort parameter to set, available list:
     * - price_asc: Sort price ascending
     * - price_desc: Sort price descending
     * @return VehicleQuery
     */
    public function setVehicleSorting(string $type): VehicleQuery
    {
        return $this->where(['sort' => $type]);
    }
    
    /**
     *
     * @param Integer $year Year from
     * @return VehicleQuery
     */
    public function setYearTo(int $year): VehicleQuery
    {
        return $this->where(['yearto' => $year]);
    }
    
    /**
     *
     * @param integer $equipmentId Equipment Paramters like: 10 = Klimatisierung.
     * @return VehicleQuery
     */
    public function setEquipment(int $equipmentId): VehicleQuery
    {
        return $this->where(['equipor' => $equipmentId]);
    }

    /**
     * Sets the language for the current vehicle query.
     * This method updates the query conditions to filter results based on the specified language code.
     * It allows method chaining by returning the modified VehicleQuery
     *
     * @param string $lng Language code Paramters like: de, fr, it
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setLng(string $lng): VehicleQuery
    {
        return $this->where(['lng' => $lng]);
    }

    /**
     * Set the current page for the query.
     *
     * @param int $page The page number to set.
     * @return VehicleQuery The updated query instance.
     */
    public function setPage(int $page): VehicleQuery
    {
        return $this->where(['page' => $page]);
    }

    /**
     * Set the number of items per page.
     *
     * @param int $amount The number of items to display per page.
     * @return VehicleQuery
     */
    public function setItemsPerPage(int $amount): VehicleQuery
    {
        return $this->where(['itemsPerPage' => $amount]);
    }

    /**
     * Set the make of the vehicle.
     *
     * @param int $makeId The ID of the vehicle make.
     * @return VehicleQuery Returns the current instance of VehicleQuery with the specified make applied.
     */
    public function setMake(int $makeId): VehicleQuery
    {
        return $this->where(['make' => $makeId]);
    }

    /**
     * Set the model for the vehicle query.
     *
     * @param int $modelId The ID of the model to set.
     * @return VehicleQuery The updated vehicle query instance.
     */
    public function setModel(int $modelId): VehicleQuery
    {
        return $this->where(['model' => $modelId]);
    }

    private array $_filters = [];

    /**
     * Add arrayable filters on client side, this is performance ineffcient.
     *
     * ```php
     * $query->filter('TransmissionTypeId', 20);
     * ```
     *
     * @param string $key
     * @param mixed $value
     * @return VehicleQuery
     */
    public function filter(string $key, $value): VehicleQuery
    {
        $this->_filters[$key] = $value;

        return $this;
    }

    private array $_orFilters = [];

    public function orFilter($key, $value): VehicleQuery
    {
        $this->_orFilters[] = [$key, $value];

        return $this;
    }

    /**
     * Search for columns with the given search value, returns the full array with all valid items.
     *
     * > This function is not casesensitive, which means FOO will match Foo, foo and FOO
     *
     * ```php
     * $array = [
     *     ['name' => 'luya', 'userId' => 1],
     *     ['name' => 'nadar', 'userId' => 1],
     * ];
     *
     * $result = ArrayHelper::searchColumn($array, 'userId', '1');
     *
     * // output:
     * // array (
     * //     array ('name' => 'luya', 'userId' => 1),
     * //     array ('name' => 'nadar', 'userId' => 1)
     * // );
     * ```
     *
     * @param array $array The multidimensional array input
     * @param string $column The column to compare with $search string
     * @param mixed $search The search string to compare with the column value.
     * @return array Returns an array with all valid elements.
     */
    public static function searchColumns(array $array, string $column, $search): array
    {
        $keys = array_filter($array, function($var) use ($column, $search) {
            return strcasecmp($search, $var[$column]) == 0 ? true : false;
        });
    
        return $keys;
    }

    /**
     * Retrieves the response from the vehicles endpoint based on specified conditions.
     *
     * @return mixed
     * @throws Exception
     */
    public function getResponse()
    {
        return $this->getClient()->endpointResponse('vehicles', $this->_where);
    }
    
    /**
     * Creates and returns a VehicleQueryIterator after applying filters to the given data.
     *
     * @param array $vehicles The array of vehicles to be included in the iterator.
     * @param int $currentPageResultCount The number of results on the current page.
     * @param int $currentPage The current page number.
     * @param int $totalResultCount The total number of results available.
     * @param int $totalPages The total number of pages available.
     * @return VehicleQueryIterator The iterator containing the filtered vehicles and pagination information.
     */
    private function createIterator(array $vehicles, int $currentPageResultCount, int $currentPage, int $totalResultCount, int $totalPages): VehicleQueryIterator
    {
        foreach ($this->_filters as $column => $search) {
            $vehicles = self::searchColumns($vehicles, $column, $search);
        }

        if (!empty($this->_orFilters)) {
            $data = $vehicles;

            $vehicles = [];
            
            foreach ($this->_orFilters as $keys) {
                list($column, $search) = $keys;
                $vehicles = array_merge(self::searchColumns($data, $column, $search), $vehicles);
            }
        }
        
        $iterator = new VehicleQueryIterator($vehicles);
        $iterator->currentPageResultCount = $currentPageResultCount;
        $iterator->currentPage = $currentPage;
        $iterator->totalPages = $totalPages;
        $iterator->totalResultCount = $totalResultCount;
        return $iterator;
    }

    /**
     * Find pages
     * @return VehicleQueryIterator
     * @throws Exception
     */
    public function find(): VehicleQueryIterator
    {
        $each = $this->getResponse();

        return $this->createIterator($each['Vehicles'], $each['ItemsOnPage'], $each['CurrentPage'], $each['TotalMatches'], $each['TotalPages']);
    }
    
    /**
     * Generates multiple requests in order to ignore page row limitation.
     *
     * Attention: May use lot of RAM usage and take some time to response, depending
     * on how much cars you have in your list.
     *
     * @return VehicleQueryIterator
     * @throws Exception
     */
    public function findAll(): VehicleQueryIterator
    {
        $each = $this->getClient()->endpointResponse('vehicles', $this->_where);
        
        if (empty($each) || !array_key_exists('Vehicles', $each)) {
            return $this->createIterator([], 0, 0, 0, 0);
        }

        $data = $each['Vehicles'];

        for ($i = 2; $i <= $each['TotalPages']; $i++) {
            $query = new self();
            $query->setClient($this->getClient());
            $query->setPage($i);
            $query->where($this->_where);
            $r = $query->getResponse();

            $data = array_merge($data, $r['Vehicles']);
        }
        
        return $this->createIterator($data, $each['TotalMatches'], 1, $each['TotalMatches'], 1);
    }

    /**
     * Retrieves a single vehicle by its ID.
     *
     * @param int $id The unique identifier of the vehicle to retrieve.
     * @return Vehicle The vehicle object corresponding to the provided ID.
     * @throws Exception If the response from the client is invalid or an error occurs.
     */
    public function findOne(int $id): Vehicle
    {
        $response = $this->getClient()->endpointResponse('vehicles/' . $id);

        return (new Vehicle($response));
    }
}
