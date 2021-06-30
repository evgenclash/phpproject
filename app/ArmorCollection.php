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
            default:
                $this->primaryWeapon[] = $armor;
        }
//
    }

    public function getAllWeapons(): array
    {
        return [
            'PrimaryWeapon' => $this->primaryWeapon,
            'SecondaryWeapon' => $this->secondaryWeapon,
            'Gadget' => $this->gadget,
            'UniqueAbility' => $this->uniqueAbility,
        ];
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

    public function checkUnique(Armor $armor): bool
    {
        foreach ($this->getAllWeapons() as $weapon){

            if ($weapon === $armor){

                return false;
            }
        }

        return true;
    }
}