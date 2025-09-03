<?php

namespace App\Livewire\Tenants\Usuarios\Usuarios;

use App\Models\Contabilidad\Transaccion;
use App\Models\User;
use App\Models\Usuarios\UserInTenant;
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


        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => UserInTenant::query())
            ->columns([
                TextColumn::make('id'),

                TextColumn::make('name')
                    ->searchable()
                    ->label('Nombre'),

                TextColumn::make('email')
                    ->label('Correo Electrónico'),

                    TextColumn::make('global_id')
                        ->label('ID Global'),

                TextColumn::make('created_at')
                    ->label('Fecha de Creación'),
            ])
            ->filters([], layout: FiltersLayout::AboveContent)
            ->headerActions([
                CreateAction::make()
                    ->label('Crear Usuario')
                    ->form($this->createOrEditForm())
                    ->action(function (array $data): void {


                        CreateUserTenant::makeUserTenant($data['name'], $data['email'], tenant())
                            ->create();

                        // Notification::make()
                        //     ->title('Usuario creado exitosamente')
                        //     ->success()
                        //     ->send();
                    }),

            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Ver Detalles')
                        ->icon('heroicon-o-eye'),
                    EditAction::make()
                        ->form($this->createOrEditForm()),
                    DeleteAction::make()
                        ->action(function (UserInTenant $record): void {
                            CreateUserTenant::makeUserTenant($record->name, $record->email, tenant())
                                ->delete();
                        })
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
        return view('livewire.tenants.usuarios.usuarios.list-usuarios');
    }
}
