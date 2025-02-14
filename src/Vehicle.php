<?php

namespace Indielab\AutoScout24;

/**
 *
 * @author Basil Suter <basil@nadar.io>
 */
class Vehicle
{
    private $_data = null;
    
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Parser the wired date string from autoscout to unix timestamps.
     *
     * @param string $date String from AutoScout like `/Date(1486132651000+0100)/`
     * @return float|int
     */
    public static function dateParser(string $date)
    {
        $match = preg_match('/([0-9]+)/', $date, $result);
        
        if ($match === 1 && isset($result[0])) {
            return (int) $result[0]/1000;
        }
        
        return 0;
    }
    
    /**
     * @return integer The vevicle id to query any further infos.
     */
    public function getId()
    {
        return $this->_data['Id'];
    }
    
    public function getMakeText()
    {
        return $this->_data['MakeText'];
    }
    
    public function getAccountId()
    {
        return $this->_data['AccountId'];
    }
    
    public function getBodyColorId()
    {
        return $this->_data['BodyColorId'];
    }
    
    /**
     * @return string i.e. `weiss`
     */
    public function getBodyColorText()
    {
        return $this->_data['BodyColorText'];
    }
    
    public function getBodyTypeId()
    {
        return $this->_data['BodyTypeId'];
    }
    
    /**
     * @return string i.e. `Kleinwagen`
     */
    public function getBodyTypeText()
    {
        return $this->_data['BodyTypeText'];
    }
    
    public function getCarNumber()
    {
        return $this->_data['CarNumber'];
    }
    
    public function getCcm()
    {
        return $this->_data['Ccm'];
    }
    
    public function getCertificationCode()
    {
        return $this->_data['CertificationCode'];
    }
    
    public function getChassisCode()
    {
        return $this->_data['ChassisCode'];
    }
    
    public function getCo2Emission()
    {
        return $this->_data['Co2Emission'];
    }
    
    public function getCo2EmissionAverage()
    {
        return $this->_data['Co2EmissionAverage'];
    }
    
    /**
     * @return string i.e. `134 g/km`
     */
    public function getCo2EmissionAverageText()
    {
        return $this->_data['Co2EmissionAverageText'];
    }

    /**
     * The extra comment section where the dealer can input data.
     *
     * @return string i.e. `Vielen Dank für Ihr Interesse...`
     */
    public function getComments()
    {
        return $this->_data['Comments'];
    }
    
    public function getConditionTypeId()
    {
        return $this->_data['ConditionTypeId'];
    }

    public function getConditionTypeText()
    {
        return $this->_data['ConditionTypeText'];
    }
    
    public function getConsumptionCity()
    {
        return $this->_data['ConsumptionCity'];
    }
    
    public function getConsumptionGas()
    {
        return $this->_data['ConsumptionGas'];
    }
    
    public function getConsumptionGasText()
    {
        return $this->_data['ConsumptionGasText'];
    }
    
    public function getConsumptionLand()
    {
        return $this->_data['ConsumptionLand'];
    }
    
    public function getConsumptionPower()
    {
        return $this->_data['ConsumptionPower'];
    }
    
    public function getConsumptionPowerText()
    {
        return $this->_data['ConsumptionPowerText'];
    }
    
    public function getConsumptionRatingText()
    {
        return $this->_data['ConsumptionRatingText'];
    }

    public function getConsumptionRatingTypeId()
    {
        return $this->_data['ConsumptionRatingTypeId'];
    }
    
    public function getConsumptionTotal()
    {
        return $this->_data['ConsumptionTotal'];
    }
        
    public function getConsumptionTotalText()
    {
        return $this->_data['ConsumptionTotalText'];
    }
    
    public function getCylinders()
    {
        return $this->_data['Cylinders'];
    }
    
    /**
     * @return integer Returns Unix timestamp
     */
    public function getDateCreated()
    {
        return self::dateParser($this->_data['DateCreated'] ?? "");
    }
    
    /**
     * @return integer Returns Unix timestamp
     */
    public function getDateModified()
    {
        return self::dateParser($this->_data['DateModified'] ?? "");
    }
    
    /**
     * @return integer Returns Unix timestamp
     */
    public function getDateOfLastInspection()
    {
        return self::dateParser($this->_data['DateOfLastInspection'] ?? "");
    }
    
    /**
     * @return integer Returns Unix timestamp
     */
    public function getDateTopListing()
    {
        return self::dateParser($this->_data['DateTopListing'] ?? "");
    }
    
    public function getDealerPrice()
    {
        return $this->_data['DealerPrice'];
    }
    
    public function getDocuments()
    {
        return $this->_data['Documents'];
    }

    public function getDoors()
    {
        return $this->_data['Doors'];
    }
    
    public function getDriveTypeId()
    {
        return $this->_data['DriveTypeId'];
    }
    
    public function getDriveTypeText()
    {
        return $this->_data['DriveTypeText'];
    }
    
    public function getOptionalEquipment()
    {
        return $this->_data['Equipment']['AutoIDatEquipment']['OptionalEquipment'] ?? null;
    }
    
    public function getStandardEquipment()
    {
        return $this->_data['Equipment']['AutoIDatEquipment']['StandardEquipment'] ?? null;
    }
    
    public function getStandardItems()
    {
        return $this->_data['Equipment']['AutoIDatEquipment']['StandardItems'] ?? null;
    }

    public function getOptionalItems()
    {
        return $this->_data['Equipment']['AutoIDatEquipment']['OptionalItems'] ?? null;
    }
    
    public function getStandardPackages()
    {
        return $this->_data['Equipment']['AutoIDatEquipment']['StandardPackages'] ?? null;
    }
    
    public function getOptionalPackages()
    {
        return $this->_data['Equipment']['AutoIDatEquipment']['OptionalPackages'] ?? null;
    }

    public function getStandardEquipmentFlatList()
    {
        return $this->_data['Equipment']['StandardEquipmentFlatList'] ?? null;
    }

    public function getOptionalEquipmentFlatList()
    {
        return $this->_data['Equipment']['OptionalEquipmentFlatList'] ?? null;
    }
    
    public function getEurotaxEquipment()
    {
        return $this->_data['Equipment']['EurotaxEquipment'];
    }
    
    public function getEurotaxEquipmentUncategorized()
    {
        return $this->_data['Equipment']['EurotaxEquipmentUncategorized'];
    }
    
    public function getSearchableEquipment()
    {
        return $this->_data['Equipment']['SearchableEquipment'];
    }
    
    public function getExtras()
    {
        return $this->_data['Extras'];
    }
    
    public function getFirstRegMonth()
    {
        return $this->_data['FirstRegMonth'];
    }
    
    public function getFirstRegYear()
    {
        return $this->_data['FirstRegYear'];
    }
    
    public function getFuelTypeId()
    {
        return $this->_data['FuelTypeId'];
    }
    
    public function getFuelTypeText()
    {
        return $this->_data['FuelTypeText'];
    }
    
    public function getHasWarranty()
    {
        return $this->_data['HasWarranty'];
    }
    
    public function getHeight()
    {
        return $this->_data['Height'];
    }
            
    public function getHp()
    {
        return $this->_data['Hp'];
    }
    
    /**
     * Get an array with all images for a specific size.
     *
     * @param string $size The size to get the data from allowed `S`, `M`, `L` and `XL`.
     * @throws Exception
     * @return array An array with image sources
     */
    public function getImages($size = 'M')
    {
        $size = strtoupper($size);
        
        if (!in_array($size, ['S', 'M', 'L', 'XL'])) {
            throw new Exception("Invalid getImage size attribute, allowed: S, M, L, XL");
        }
        
        return $this->_data['Images'][$size];
    }
    
    public function getImagesCount()
    {
        return $this->_data['ImagesCount'];
    }
    
    public function getInteriorColorId()
    {
        return $this->_data['InteriorColorId'];
    }
    
    /**
     * @return string i.e. `Schwarz`
     */
    public function getInteriorColorText()
    {
        return $this->_data['InteriorColorText'];
    }
    
    /**
     * @return integer i.e. `2324`
     */
    public function getKm()
    {
        return $this->_data['Km'];
    }
    
    /**
     * @return float i.e. `8.05423`
     */
    public function getLatitude()
    {
        return $this->_data['Latitude'];
    }
    
    public function getLength()
    {
        return $this->_data['Length'];
    }

    public function getLicenseCategoryText()
    {
        return $this->_data['LicenseCategoryText'];
    }
    
    public function getLicenseCategoryTypeId()
    {
        return $this->_data['LicenseCategoryTypeId'];
    }
    
    public function getLogoDescription()
    {
        return $this->_data['LogoDescription'];
    }
    
    public function getLogoId()
    {
        return $this->_data['LogoId'];
    }
    
    public function getLogoImageUrl()
    {
        return $this->_data['LogoImageUrl'];
    }
    
    public function getLogoText()
    {
        return $this->_data['LogoText'];
    }
    
    public function getLogoUrl()
    {
        return $this->_data['LogoUrl'];
    }
    
    public function getLongitude()
    {
        return $this->_data['Longitude'];
    }
    
    public function getMakeId()
    {
        return $this->_data['MakeId'];
    }
    
    public function getModelGroupId()
    {
        return $this->_data['ModelGroupId'];
    }
    
    public function getModelGroupText()
    {
        return $this->_data['ModelGroupText'];
    }
    
    public function getModelId()
    {
        return $this->_data['ModelId'];
    }
    
    /**
     * @return string The Model name i.e. `ZOE`
     */
    public function getModelText()
    {
        return $this->_data['ModelText'];
    }
    
    /**
     * @return string i.e. `ZOE R90 Intens`
     */
    public function getModelTypeText()
    {
        return $this->_data['ModelTypeText'];
    }
    
    public function getPetrolEquivalent()
    {
        return $this->_data['PetrolEquivalent'];
    }
    
    public function getPetrolEquivalentText()
    {
        return $this->_data['PetrolEquivalentText'];
    }
    
    public function getPollutionNormTypeId()
    {
        return $this->_data['PollutionNormTypeId'];
    }
    
    public function getPollutionNormTypeText()
    {
        return $this->_data['PollutionNormTypeText'];
    }
    
    /**
     * Returns the price of the Vehicle as float number.
     *
     * @return float The prive as float i.e `25150`
     */
    public function getPrice()
    {
        return $this->_data['Price'];
    }
    
    /**
     * The price of the car when it was new.
     *
     * @return float
     */
    public function getPriceNew()
    {
        return $this->_data['PriceNew'];
    }
    
    /**
     * @return array An array with properties like `ab MFK`.
     */
    public function getProperties()
    {
        return $this->_data['Properties'];
    }
    
    public function getSeats()
    {
        return $this->_data['Seats'];
    }
    
    public function getSegmentationTypeId()
    {
        return $this->_data['SegmentationTypeId'];
    }
    
    public function getSegmentationTypeText()
    {
        return $this->_data['SegmentationTypeText'];
    }
    
    public function getSeller()
    {
        return new Seller($this->_data['Seller']);
    }
    
    /**
     * @return string i.e. `jetzt mit grösser Batterie und verlängerter Reichweite!`
     */
    public function getTeaser()
    {
        return $this->_data['Teaser'];
    }
    
    public function getTrailerLoadBreaked()
    {
        return $this->_data['TrailerLoadBreaked'];
    }
    
    public function getTransmissionTypeId()
    {
        return $this->_data['TransmissionTypeId'];
    }
    
    public function getTransmissionTypeText()
    {
        return $this->_data['TransmissionTypeText'];
    }
    
    /**
     * @return string i.e. `R90 Intens`
     */
    public function getTypeName()
    {
        return $this->_data['TypeName'];
    }
    
    /**
     * @return string i.e. `RENAULT ZOE R90 Intens`
     */
    public function getTypeNameFull()
    {
        return $this->_data['TypeNameFull'];
    }
    
    public function getUrl()
    {
        return $this->_data['Url'];
    }

    public function getUserType()
    {
        return $this->_data['UserType'];
    }
    
    public function getVehicleType()
    {
        return $this->_data['VehicleType'];
    }
    
    /**
     * @return string i.e. `Personenwagen`
     */
    public function getVehicleTypeText()
    {
        return $this->_data['VehicleTypeText'];
    }
    
    /**
     * @return array Returns an array with links to the video.
     */
    public function getVideos()
    {
        return $this->_data['Videos'];
    }
    
    public function getVisibilityId()
    {
        return $this->_data['VisibilityId'];
    }

    public function getWarrantyDescription()
    {
        return $this->_data['WarrantyDescription'];
    }
    
    public function getWarrantyMonths()
    {
        return $this->_data['WarrantyMonths'];
    }
    
    public function getWeight()
    {
        return $this->_data['Weight'];
    }

    public function getWidth()
    {
        return $this->_data['Width'];
    }

    public function getLeasingCalculatorUrl()
    {
        return $this->_data['LeasingCalculatorUrl'];
    }
}
