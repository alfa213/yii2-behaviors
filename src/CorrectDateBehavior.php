<?php

namespace lav45\behaviors;

use Yii;
use yii\di\Instance;
use yii\i18n\Formatter;

/**
 * Class CorrectDateBehavior
 * @package lav45
 *
 *  public function behaviors()
 *  {
 *      return [
 *          [
 *              'class' => CorrectDateBehavior::class,
 *              'formatter' => [
 *                  'timeZone' => 'UTC',
 *                  'datetimeFormat' => 'dd.MM.yyyy HH:mm:ss',
 *              ],
 *              'format' => 'datetime',
 *              'attributes' => [
 *                  'dateFrom' => 'date_from',
 *                  'dateTo' => 'date_to',
 *              ]
 *          ]
 *      ];
 *  }
 *
 */
class CorrectDateBehavior extends AttributeBehavior
{
    /**
     * @inheritdoc
     */
    public $attributes;
    /**
     * @var string|array|Formatter
     */
    public $formatter = 'formatter';
    /**
     * @var string
     */
    public $format = 'datetime';

    /**
     * @return Formatter
     */
    private function getFormatter()
    {
        if (!$this->formatter instanceof Formatter) {
            $this->formatter = Instance::ensure($this->formatter, Formatter::class);
        }
        return $this->formatter;
    }

    /**
     * @param $name string
     * @return string|null
     */
    public function getAttribute($name)
    {
        if ($value = $this->owner->{$this->attributes[$name]}) {
            return $this->getFormatter()->format($value, $this->format);
        }
        return null;
    }

    /**
     * @param string|null $name
     * @param string $value
     */
    public function setAttribute($name, $value)
    {
        if (empty($value)) {
            $this->owner->{$this->attributes[$name]} = null;
        } else {
            $formatter = $this->getFormatter();
            $this->owner->{$this->attributes[$name]} = $formatter->asTimestamp($value . ' ' . $formatter->timeZone);
        }
    }
}