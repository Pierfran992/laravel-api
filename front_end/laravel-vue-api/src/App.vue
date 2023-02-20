<script>
import axios from 'axios';

const api_url = 'http://127.0.0.1:8000/api/v1/';

const empty_new_movie = {
    tags_id: []
}

export default {
    name: 'App',

    data() {
        return {
            movies: [],
            tags: [],
            genres: [],

            new_movie: { ...empty_new_movie },
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
        },

        deleteMovie(movie) {
            axios.delete(api_url + 'movie/delete/' + movie.id)
                .then(res => {

                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.printMovie();
                    }
                }).catch(err => console.log);
        },

        createMovie(e) {
            e.preventDefault();

            const new_movie = this.new_movie;
            const actualApi = api_url + (
                'id' in new_movie
                    ? 'movie/update/' + this.new_movie.id
                    : 'movie/store'
            );

            axios.post(actualApi, new_movie)
                .then(res => {
                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.printMovie();
                        this.new_movie = { ...empty_new_movie };
                    }
                }).catch(err => console.log);
        },

        editMovie(movie) {

            this.new_movie = { ...movie };
            this.new_movie.tags_id = [];

            for (let i = 0; i < movie.tags.length; i++) {
                const tag = movie.tags[i];
                this.new_movie.tags_id.push(tag.id);
            }
        },

    },

    mounted() {
        this.printMovie();
    }
}
</script>

<template>
    <h1>My Movie List</h1>

    <div>
        <h2 v-if="'id' in new_movie">Edit Movie</h2>
        <h2 v-else>Create a new Movie</h2>

        <form>
            <label for="name">Name</label>
            <input type="text" name="name" v-model="new_movie.name">
            <br>
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" v-model="new_movie.release_date">
            <br>
            <label for="cashOut">Cash Out</label>
            <input type="number" name="cashOut" v-model="new_movie.cashOut">
            <br>
            <label for="genre">Genre</label>
            <select name="genre_id" v-model="new_movie.genre_id">
                <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name }}</option>
            </select>
            <br>
            <label>Tags:</label>
            <div v-for="tag in tags" :key="tag.id">
                <input type="checkbox" :id="'tag-' + tag.id" :value="tag.id" v-model="new_movie.tags_id">
                <label :for="'tag-' + tag.id">{{ tag.name }}</label>
            </div>
            <input type="submit" :value="'id' in new_movie ? 'UPDATE MOVIE: ' + new_movie.id : 'CREATE NEW MOVIE'"
                @click="createMovie">
        </form>
    </div>

    <hr>

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
            <button @click="editMovie(movie)">Edit</button>
            <button @click="deleteMovie(movie)">Delete</button>
            <hr>
        </li>
    </ul>
</template>

<style scoped></style>
