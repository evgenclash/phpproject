<?php


namespace App;


class ArmorCollection
{
    private array $primaryWeapon = [];
    private array $secondaryWeapon = [];
    private array $gadget = [];
    private array $uniqueAbility = [];

    public function addArmor(Armor $armor)
    {
        switch ($armor->getCategory()){
            case 'Primary Weapon':
                $this->primaryWeapon[] = $armor;
                break;
            case 'Secondary Weapon':
                $this->secondaryWeapon[] = $armor;
                break;
            case 'Gadget':
                $this->gadget[] = $armor;
                break;
            case 'Unique Ability':
                $this->uniqueAbility[] = $armor;
                break;

                $this->primaryWeapon[] = $armor;
        }
//
    }

    public function getAllWeapons(): array
    {
        $weapons['PrimaryWeapon'] = $this->primaryWeapon;
        $weapons['SecondaryWeapon'] = $this->secondaryWeapon;
        $weapons['Gadget'] = $this->gadget;
        $weapons['UniqueAbility'] = $this->uniqueAbility;

        return $weapons;
    }

    public function getPrimaryWeapon(): array
    {
        return $this->primaryWeapon;
    }

    public function getSecondaryWeapon(): array
    {
        return $this->secondaryWeapon;
    }

    public function getGadget(): array
    {
        return $this->gadget;
    }

    public function getUniqueAbility(): array
    {
        return $this->uniqueAbility;
    }
}