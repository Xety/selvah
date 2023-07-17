<?php

namespace Selvah\Models\Presenters;

trait LotPresenter
{
    /**
     * Get the crude_oil_yield.
     *
     * Rendement Huile Brute (%)
     *
     * @return string
     */
    public function getCrudeOilYieldAttribute(): string
    {
        if (!isset($this->crude_oil_production) || !isset($this->crushed_seeds)) {
            return 0;
        }

        return round(($this->crude_oil_production / $this->crushed_seeds) * 100, 2);
    }

    /**
     * Get the soy_hull_yield.
     *
     * Rendement de coques (%)
     *
     * @return string
     */
    public function getSoyHullYieldAttribute(): string
    {
        if (!isset($this->soy_hull) || !isset($this->crushed_seeds)) {
            return 0;
        }

        return round(($this->soy_hull / $this->crushed_seeds) * 100, 2);
    }

    /**
     * Get the crushed_waste.
     *
     * Freinte trituration (%)
     *
     * @return string
     */
    public function getCrushedWasteAttribute(): string
    {
        if (
            !isset($this->crushed_seeds) ||
            !isset($this->crude_oil_production) ||
            !isset($this->soy_hull) ||
            !isset($this->extruded_flour)
        ) {
            return 0;
        }

        return round(((
                $this->crushed_seeds -
                $this->crude_oil_production -
                $this->soy_hull -
                $this->extruded_flour
            ) / $this->crushed_seeds) * 100, 2);
    }

    /**
     * Get the non_compliant_bagged_tvp.
     *
     * Tonnage ensaché NC (Kg)
     *
     * @return string
     */
    public function getNonCompliantBaggedTvpAttribute(): string
    {
        if (!isset($this->bagged_tvp) || !isset($this->compliant_bagged_tvp)) {
            return 0;
        }

        return round($this->bagged_tvp - $this->compliant_bagged_tvp, 2);
    }

    /**
     * Get the non_compliant_bagged_tvp_yield.
     *
     * Rendement PVT non-conforme (%)
     *
     * @return string
     */
    public function getNonCompliantBaggedTvpYieldAttribute(): string
    {
        if (!isset($this->compliant_bagged_tvp) || !isset($this->crushed_seeds)) {
            return 0;
        }

        return round((100 - ($this->compliant_bagged_tvp / $this->bagged_tvp) * 100), 2);
    }

    /**
     * Get the compliant_bagged_tvp_yield.
     *
     * Rendement PVT conforme (%)
     *
     * @return string
     */
    public function getCompliantBaggedTvpYieldAttribute(): string
    {
        if (!isset($this->compliant_bagged_tvp) || !isset($this->crushed_seeds)) {
            return 0;
        }

        return round(($this->compliant_bagged_tvp / $this->crushed_seeds) * 100, 2);
    }

    /**
     * Get the extrusion_waste.
     *
     * Freinte à l'extrusion (%)
     *
     * @return string
     */
    public function getExtrusionWasteAttribute(): string
    {
        if (!isset($this->extruded_flour) || !isset($this->bagged_tvp)) {
            return 0;
        }

        return round((($this->extruded_flour - $this->bagged_tvp) / $this->extruded_flour) * 100, 2);
    }

    /**
     * Get the lot_waste.
     *
     * Freinte total du lot (%)
     *
     * @return string
     */
    public function getLotWasteAttribute(): string
    {
        if (
            !isset($this->crushed_seeds) ||
            !isset($this->crude_oil_production) ||
            !isset($this->soy_hull) ||
            !isset($this->bagged_tvp)
        ) {
            return 0;
        }

        return round(((
                $this->crushed_seeds -
                $this->crude_oil_production -
                $this->soy_hull -
                $this->bagged_tvp
            ) / $this->crushed_seeds) * 100, 2);
    }
}
