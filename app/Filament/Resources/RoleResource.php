<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages\CreateRole;
use App\Filament\Resources\RoleResource\Pages\EditRole;
use App\Filament\Resources\RoleResource\Pages\ListRoles;
use App\Filament\Resources\RoleResource\Pages\ViewRole;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RoleResource extends \Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                                    ->required()
                                    ->maxLength(60)
                                    ->unique(ignoreRecord: true),
                                Select::make('permissions')
                                    ->columnSpanFull()
                                    ->multiple()
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions'))
                                    ->relationship(
                                        name: 'permissions',
                                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('name'),
                                    )
                                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} ({$record->guard_name})")
                                    ->searchable(['name', 'guard_name']) // searchable on both name and guard_name
                                    ->preload(config('filament-spatie-roles-permissions.preload_permissions')),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions_count')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\RelationManager\PermissionRelationManager::class,
            \Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\RelationManager\UserRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
            'view' => ViewRole::route('/{record}'),
        ];
    }
}
