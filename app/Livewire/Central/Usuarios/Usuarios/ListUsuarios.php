<?php

namespace App\Livewire\Central\Usuarios\Usuarios;

use App\Models\Contabilidad\Transaccion;
use App\Models\Tenants\Tenant;
use App\Models\User;
use App\Models\Usuarios\CentralUser;
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
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;



use Livewire\Component;

class ListUsuarios extends Component implements HasActions, HasSchemas, HasTable
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
                ->email()
                ->unique(ignoreRecord: true)
                ->required(),

            Toggle::make('is_central_user')
                ->label('¿Es solo usuario central?')
                ->default(false),

            CheckboxList::make('tenants')
                ->searchable()
                ->relationship()
                ->getOptionLabelFromRecordUsing(fn(Tenant $record) => $record->name)

        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => CentralUser::query())
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('tenants.name'),
                IconColumn::make('is_central_user')
                    ->boolean(),
                TextColumn::make('created_at'),
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
        return view('livewire.central.usuarios.usuarios.list-usuarios');
    }
}
