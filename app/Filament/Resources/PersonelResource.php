<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Entite;
use App\Models\Personel;
use Filament\Forms\Form;


use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PersonelResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersonelResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class PersonelResource extends Resource
{
    protected static ?string $model = Personel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Matricle')
                    ->required(),
                Forms\Components\TextInput::make('Nom')
                    ->required(),
                Forms\Components\TextInput::make('Prenom')
                    ->required(),


                Select::make('entite_id')
                    ->label('entires')
                    ->options(Entite::all()->pluck('Nom', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('Observation')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Matricle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('entite_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Observation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->headerActions([

                FilamentExportHeaderAction::make('export')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonels::route('/'),
            'create' => Pages\CreatePersonel::route('/create'),
            'edit' => Pages\EditPersonel::route('/{record}/edit'),
        ];
    }
}
