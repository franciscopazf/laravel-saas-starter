<?php

namespace App\Livewire\Central\Tenants\Tenant;

use App\Models\Tenants\Tenant;
use App\Models\Contabilidad\Transaccion;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Livewire\Component;

use Filament\Forms\Components\Repeater;

class ListTenants extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;


    public function createOrEditForm(): array
    {
        return [

            TextInput::make('name')
                ->label('Nombre')
                ->required(),

            TextInput::make('email')
                ->label('Correo Electrónico')
                ->required()
                ->email(),

            TextInput::make('phone')
                ->label('Teléfono')
                ->required(),


            Repeater::make('domains')
                ->relationship('domains')
                ->label('Dominio')
                ->minItems(1)
                ->maxItems(1)
                ->schema([
                    TextInput::make('domain')
                        ->label('Subdominio')
                        ->prefix('https://')
                        ->required(),
                ])
                ->deletable(false)



        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Tenant::query())
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('domains.domain'),
            ])
            ->filters([], layout: FiltersLayout::AboveContent)
            ->headerActions([
                CreateAction::make()
                    ->label('Crear Color de Impresión')
                    ->form($this->createOrEditForm())
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Ver Detalles')
                        ->icon('heroicon-o-eye'),
                    EditAction::make()
                        ->form($this->createOrEditForm()),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.central.tenants.tenant.list-tenants');
    }
}
