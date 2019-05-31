@extends('layouts.app')

@section('content')

    <style>
        ::placeholder {
            color: red;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: red;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: red;
        }

        ::-moz-placeholder {
            color: #f00;
            opacity: 1
        }

        ::-webkit-input-placeholder {
            color: #f00
        }
    </style>

    <div class="container">
        <div class="box">
            <strong>A database of dance instructions for tunes in <i>The Barnes Book of English Country Dance Tunes,
                    Volume Three</i></strong>
        </div>
        <div class="box">

            <div class="field is-grouped">
                <p class="control">
                    <input class="input is-primary"
                           id="filter"
                           placeholder="Quick Search"
                           type="text"
                           v-model="quickSearchQuery">
                </p>

                <p class="control">
                    <button @click.prevent="clearQuickSearch();"
                            class="button is-outlined is-primary"
                    >Clear
                    </button>
                </p>

                <p class="control">
                    <label class="checkbox">
                        <input type="checkbox" v-model="showPublishedDirectionsOnly">
                        Display only dances with instructions in the database.
                    </label>
                </p>
            </div>
        </div>
        <div class="box">

        </div>
    </div>

@endsection
