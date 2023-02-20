<script>
import axios from 'axios';

const api_url = 'http://127.0.0.1:8000/api/v1/';

export default {
    name: 'App',

    data() {
        return {
            movies: [],
            tags: [],
            genres: [],
        }
    },

    methods: {

        printMovie() {

            axios.get(api_url + 'movie/all')
                .then(res => {

                    const data = res.data;
                    const success = data.success;

                    const response = data.response;

                    const movies = response.movies;
                    const genres = response.genres;
                    const tags = response.tags;

                    if (success) {
                        this.movies = movies;
                        this.genres = genres;
                        this.tags = tags;
                    }
                })
                .catch(err => console.log);
        }

    },

    mounted() {
        this.printMovie();
    }
}
</script>

<template>
    <h1>My Movie List</h1>

    <ul>
        <!-- film -->
        <li v-for="movie in movies" :key="movie.id">
            {{ movie.name }} - {{ movie.release_date }}
            <!-- lista dei tag del film -->
            <ul>
                <li v-for="tag in movie.tags" :key="tag.id">
                    {{ tag.name }}
                </li>
            </ul>
            <hr>
        </li>
    </ul>
</template>

<style scoped></style>
