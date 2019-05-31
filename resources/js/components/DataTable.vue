<template>

<div>

    <div >
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
            <p>Click on the rectangles to choose the columns you want to display. Click on a column heading to sort on
                that column.</p>
            <button :class="{'is-active': getVisibleColumns().includes(column)}" @click.prevent="toggleVisibility(column)"
                    class="button is-outlined is-primary is-small"
                    v-for="column in this.columnsToDisplay()">
                <span v-html="response.custom_columns[column] || column "></span>
            </button>
        </div>
    </div>









    <table class="table is-striped is-narrow is-fullwidth is-bordered">
        <thead class="has-text-centered">
        <tr>
            <template v-for="column in response.displayable">
                <th v-if="getVisibleColumns().includes(column)">
                            <span class="sortable" @click="sortBy(column)"
                                  v-html="response.custom_columns[column] || column ">
                            </span>

                    <div
                            class="arrow"
                            v-if="sort.key === column"
                            :class="{ 'arrow--asc': sort.order === 'asc', 'arrow--desc': sort.order === 'desc' }"
                    ></div>
                </th>
            </template>
        </tr>
        </thead>
        <tbody>

        <tr v-for="record in filteredRecords">

            <template v-for="columnValue, column in record">

                <td v-if="getVisibleColumns().includes(column)" v-html="record[response.custom_display_instead_of_columns[column]] || columnValue">
                </td>

            </template>

        </tr>
        </tbody>
    </table>

</div>

</template>

<script>
    // import queryString from 'query-string'

    export default {
        props: ['endpoint'],
        data() {
            return {
                response: {
                    table: [],
                    displayable: [],
                    records: [],
                    allow: {},
                    custom_sortby_columns: [],
                    visible_columns: [],
                    columns_to_ignore_in_view: {},
                    custom_display_instead_of_columns: {},
                },
                creating: {
                    active: false,
                    form: {},
                    errors: []
                },
                editing: {
                    id: null,
                    form: {},
                    errors: []
                },
                sort: {
                    key: 'title',
                    sortby_key: 'title_sort',
                    order: 'asc',
                },
                limit: 1000,
                quickSearchQuery: '',
                showPublishedDirectionsOnly: false,
                search: {
                    value: '',
                    operator: 'equals',
                    column: 'id'
                },
                visibleColumns: [],
            }
        },

        computed: {
            filteredRecords() {
                let data = this.response.records

                if (this.showPublishedDirectionsOnly) {
                    data = data.filter(record => record.directions_link);
                }

                if (this.sort.key) {
                    data = _.orderBy(data, (i) => {
                            let value = i[this.sort.sortby_key]

                            // if (
                            //     !isNaN(parseFloat(value)) && isFinite(value)
                            // ) {
                            //     return parseFloat(value)
                            // }

                            return String(i[this.sort.sortby_key]).toLowerCase()
                        },
                        this.sort.order
                    )
                }

                data = data.filter((row) => {
                    return this.getVisibleColumns().some((key) => {
                            return String(row[key]).toLowerCase().indexOf(this.quickSearchQuery.toLowerCase()) > -1
                        }
                    )
                })


                /*data.forEach(function (row) {
                    var res = row['title'].split("::");
                    var titles = res[0].split('/');
                    var titlesStr = titles.join('<br>');
                    if (res.length == 2) {
                        var link = "<a target='_blank' href='" + res[1] + "'>" + titlesStr + "</a>"
                        row['title'] = link;
                    } else {
                        row['title'] = titlesStr;
                    }

                    var tunes = row['tune'].split('/');
                    if (tunes.length > 1) {
                        var tunesStr = tunes.join('<br>');
                        row['tune'] = tunesStr;
                    }

                    if (row['source'].indexOf('http') > -1) {
                        row['source'] = "<a target='_blank' href='" + row['source'] + "'>" + "Link to Source" + "</a>";
                    }
                });*/

                return data;
            }
        },
        methods: {
            getRecords() {
                // return axios.get(`${this.endpoint}?${this.getQueryParameters()}`).then((response) => {
                return axios.get(`${this.endpoint}`).then((response) => {
                    this.response = response.data.data;
                    // this.visibleColumns = this.columnsToDisplay();
                });

            },
            // getQueryParameters() {
            //     return queryString.stringify({
            //         limit: this.limit,
            //         ...this.search
            //     })
            // },
            sortBy(column) {
                if (this.sort.key === column) {
                    this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sort.order = 'asc';
                }
                this.sort.key = column
                this.sort.sortby_key = this.response.custom_sortby_columns[column] || column
            },
            edit(record) {
                this.editing.errors = []
                this.editing.id = record.id
                this.editing.form = _.pick(record, this.response.updatable)
            },
            isUpdatable(column) {
                return this.response.updatable.includes(column)
            },
            isCustomSortByColumn(column) {
                return Object.values(this.response.custom_sortby_columns).includes(column)
            },
            columnsToDisplay() {
                var sb = Object.values(this.response.custom_sortby_columns)
                var tmp =  _.difference(this.response.displayable, sb)
                return _.difference(tmp, this.response.columns_to_ignore_in_view)
            },
            getVisibleColumns() {
                if (this.visibleColumns.length == 0) {
                    this.visibleColumns = _.difference( this.response.visible_columns, this.response.columns_to_ignore_in_view);
                }
                // return this.visibleColumns;
                return _.difference( this.visibleColumns, this.response.columns_to_ignore_in_view);
            },
            toggleVisibility(column) {
                if (this.visibleColumns.includes(column)) {
                    this.visibleColumns.push(column)
                    _.pull(this.visibleColumns, column)
                }
                else {
                    this.visibleColumns.push(column)
                }
            },
            clearQuickSearch() {
                this.quickSearchQuery = '';
            },
            isLink(columnValue) {
                return columnValue.indexOf('http') > -1
            },
            update() {
                axios.patch(`${this.endpoint}/${this.editing.id}`, this.editing.form).then(() => {
                    this.getRecords().then(() => {
                        this.editing.id = null
                        this.editing.form = null
                    })
                }).catch((error) => {
                    if (error.response.status === 422
                    ) {
                        this.editing.errors = error.response.data.errors
                    }
                })
            },
            store() {
                axios.post(`${this.endpoint}`, this.creating.form).then(() => {
                    this.getRecords().then(() => {
                        this.creating.active = false
                        this.creating.form = {}
                        this.creating.errors = []
                    })
                }).catch((error) => {
                    if (error.response.status === 422
                    ) {
                        this.creating.errors = error.response.data.errors
                    }
                })
            },
        },

        mounted() {
            this.getRecords();
            // this.visibleColumns = this.columnsToDisplay();
        },
    }
</script>

<style lang="scss">
    @import '~@/_variables.scss';

    .sortable {
        cursor: pointer;
    }


    .button.is-small {
        line-height: 1.0;
        height: 3em;
        font-size: .85rem;
    }

    .button.is-primary.is-outlined:hover, .button.is-primary.is-outlined.is-hovered,
    .button.is-primary.is-outlined:focus, .button.is-primary.is-outlined.is-focused {
        background-color: $grey;
        border-color: $primary;
        color: $primary;
    }

    .button.is-primary.is-outlined {
         background-color: $grey;
     }
    .button.is-primary.is-outlined.is-active {
        background-color: transparent;
        font-weight: bold;
    }

    .btn-primary-outline {
        background-color: $grey;
        border-color: #999;
    }

    .button {
        background-color: $grey;
    }

    .button.active {
        background-color: white;
        font-weight: bold;
    }

    .box:not(:last-child) {
        margin-bottom: 0.1rem;
    }
    .box {
        padding: 0.5rem 1.75rem;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: 0.66;

        &--asc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #222;
        }

        &--desc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #222;
        }
    }

    .table {
        line-height: 1;
    }
    .table th {
        text-align: center;
        vertical-align: middle;
    }
    .table th:not([align]) {
        text-align: center;
    }


    .barnes-table {
        table-layout: fixed;
        width: 100%;
        white-space: nowrap;
    }

    .barnes-table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
        word-wrap: break-word;
    }
</style>
