<?php

namespace ukf;

class Menu
{
    private $sourceFileName = "source/command.csv";

    public function getMenuData(string $type): array
    {
        $menu = [];

        if ($this->validateMenuType($type)) {
            if ($type === "header") {
                try {$csvFile = fopen($this->sourceFileName, 'r');

                    while (($udaj = fgetcsv($csvFile)) !== false) {
                        $menu[$udaj[0]] = [
                            'name' => $udaj[1],
                            'path' => $udaj[2]
                        ];
                    }

                    fclose($csvFile);
                } catch (\Exception $exception) {//echo $exception->getMessage();
                }
            }
        }

        return $menu;
    }

    public function printMenu(array $menu)
    {
        foreach ($menu as $menuName => $menuData) {
            echo '<li><a href="' . $menuData['path'] . '">' . $menuData['name'] . '</a></li>';
        }
    }

    private function validateMenuType(string $type): bool
    {
        $menuTypes = [
            'header',
            'footer'
        ];

        if (in_array($type, $menuTypes)) {
            return true;
        } else {
            return false;
        }
    }


    public function preparePortfolio(int $numberOfRows = 2, int $numberOfCols = 4): array
    {
        $portfolio = [];
        $colIndex = 1;

        for ($i = 1; $i <= $numberOfRows; $i++) {
            for ($j = 1; $j <= $numberOfCols; $j++) {
                $portfolio[$i][] = $colIndex;
                $colIndex++;
            }
        }

        return $portfolio;
    }
}


?>