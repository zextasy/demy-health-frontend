import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import './bootstrap';
import flatpickr  from "flatpickr";
import { createPopper } from "@popperjs/core";

window.Alpine = Alpine;

Livewire.start();
window.createPopper = createPopper;

