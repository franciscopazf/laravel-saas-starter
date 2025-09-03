<?php

namespace App\Livewire\Universal\Acceso\Usuarios;

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
use Filament\Tables\Columns\ImageColumn;

use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ListUsuarios extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;


    public function createOrEditForm(): array
    {
        return [



            CheckboxList::make('roles')
                ->label('Permisos')
                ->bulkToggleable()
                ->relationship(name: 'roles', titleAttribute: 'name')
                ->columns(3)
                ->searchable(),


        ];
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => CentralUser::query())
            ->columns([


                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('microsoft_id')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('givenname')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sur_name')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar Roles de Usuario')
                    ->form($this->createOrEditForm()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.universal.acceso.usuarios.list-usuarios');
    }
}
