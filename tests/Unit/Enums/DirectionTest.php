<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Enums\Transaction\Direction;

final class DirectionTest extends TestCase
{
    public function testDirectionHasExpectedValues(): void
    {
        $this->assertEquals('Crédito', Direction::IN->value);
        $this->assertEquals('Débito', Direction::OUT->value);
    }

    public function testToArray(): void
    {
        $expected = [
            'IN' => 'Crédito',
            'OUT' => 'Débito',
        ];

        $this->assertEquals($expected, Direction::toArray());
    }

    public function testGetValues(): void
    {
        $expected = ['Crédito', 'Débito'];

        $this->assertEquals($expected, Direction::getValues());
    }

    public function testFromValue(): void
    {
        $this->assertEquals(Direction::IN, Direction::fromValue('Crédito'));
        $this->assertEquals(Direction::OUT, Direction::fromValue('Débito'));

        $this->expectException(\InvalidArgumentException::class);
        Direction::fromValue('Valor inválido');
    }

    public function testToFilamentSelectOptions(): void
    {
        $expected = [
            'Crédito' => 'Crédito',
            'Débito' => 'Débito',
        ];

        $this->assertEquals($expected, Direction::toFilamentSelectOptions());
    }
}
