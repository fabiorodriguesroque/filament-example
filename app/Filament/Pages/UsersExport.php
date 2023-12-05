<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;



class UsersExport extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.users-export';

    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('export-users')
                ->action(function (array $data, $livewire) {
                    /**
                     * como não implementei filtros aqui ele vai buscar todos
                     * mas esta função retorna apenas os filtros se existirem.
                     */

                    dd($livewire->getFilteredTableQuery()->get());

                    /**
                     * usecase
                     * 1.  gostava de adicionar aqui um dropdownd e actions
                     *    a. exportar todos,
                     *    b. exportar selecionados
                     *
                     * portanto o que não estou a conseguir fazer é ir buscar os selecionados
                     * aqui 
                     */

                })
        ];
    }

    public function getTableBulkActions(): array
    {
        return  [
            Tables\Actions\BulkAction::make('export-users')
                ->action(function (Collection $records) {
                    /**
                     * Aqui tenho a funcionar o que pretendo, o problema é 
                     * que o stakeholder não quer com os 3 pontinhos. 
                     */
                    dd($records);
                })
        ];
    }

    public function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('email')
        ];
    }

    public function getTableQuery(): Builder
    {
        return User::query();
    }
}