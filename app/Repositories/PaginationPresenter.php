<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

//include_once('./PaginationInterface.php');

class PaginationPresenter implements PaginationInterface{

    
        /**
         * @var stdClass[]
         */
        private array $items;

        public function __construct(
            protected LengthAwarePaginator $paginator
        )
        {
            $this->items = $this->resolveItems($paginator->items());
            
        }

        /**
         * @return stdClass[]
         */

        public function items(): array{ 
            return $this->items;
        }
        public function total(): int{ 
                return $this->paginator->total() ?? 0;
        }
        public function isFirstPage(): bool{
            //dd($this->paginator->lastPage());
            return ($this->paginator->currentPage() === 1);
        }
        public function isLastPage(): bool{ 
            return ($this->paginator->currentPage() === $this->paginator->lastpage());
        }
        public function currentPage(): int{ 
             
            return $this->paginator->currentPage() ?? 1; 
        }
        public function getNumberNextPage(): int{
            if ($this->paginator->currentPage() === $this->paginator->lastpage())
                 return $this->paginator->lastpage();
            return $this->paginator->currentPage() + 1;
        }
        public function getNumberPreviousPage(): int{ 
            if ($this->paginator->currentPage() === 1)
                return 1;
            return $this->paginator->currentPage() - 1;
        }

        private function resolveItems(array $items):array{

            $response = [];
            foreach ($items as $item) {
                $stdClassObject = new stdClass;
                foreach ($item->toArray() as $key => $value) {
                    $stdClassObject->{$key} = $value;
                }
                array_push($response, $stdClassObject);
            }
            return $response;
        }

}