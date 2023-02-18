<template>
  {{ series_id }}
  <div class="container mt-4">
    <div class="text-center my-4">
      <button class="btn btn-primary" @click="showModal">Create new lesson</button>
    </div>
    <ul class="list-group">
      <li
        class="list-group-item d-flex justify-content-between"
        v-for="(lesson, key) in lessons"
        :key="lessons.indexOf(lesson)"
      >
        <p>{{ lesson.title }}</p>
        <p>
          <button class="btn btn-secondary mx-2" @click="editLesson(lesson)">Edit</button>
          <button class="btn btn-danger mx-2" @click="deleteLesson(lesson.id, key)">
            Delete
          </button>
        </p>
      </li>
    </ul>
    <CreateLesson
      :seriesId="series_id"
      @lesson_created="addNewLesson($event)"
      @lesson_updated="updateLesson($event)"
    ></CreateLesson>
  </div>
</template>
<script>
import CreateLesson from "./children/CreateLesson.vue";
import axios from "axios";
export default {
  props: ["default_lessons", "series_id"],
  components: {
    CreateLesson,
  },
  emits: ["create-mode", "edit-mode"],
  data() {
    return {
      lessons: JSON.parse(this.default_lessons),
    };
  },
  computed: {},
  methods: {
    addNewLesson(lesson) {
      window.noty({
        message: "Lesson created successfully",
        type: "success",
      });
      this.lessons.push(lesson);
      $("#createLesson").modal("hide");
    },
    deleteLesson(id, key) {
      if (confirm("Are you shure you wanna delete ?")) {
        axios
          .delete(`/admin/${this.series_id}/lessons/${id}`)
          .then((resp) => {
            this.lessons.splice(key, 1);
            window.noty({
              message: "Lesson deleted successfully",
              type: "success",
            });
          })
          .catch((error) => {
            window.handleErrors(error);
          });
      }
    },
    editLesson(lesson) {
      this.emitter.emit("edit-mode", {
        lesson,
      });
      $("#createLesson").modal("show");
    },
    showModal() {
      this.emitter.emit("create-mode");
      $("#createLesson").modal("show");
    },
    updateLesson(lesson) {
      let lessonIndex = this.lessons.findIndex((l) => {
        return l.id == lesson.id;
      });
      this.lessons.splice(lessonIndex, 1, lesson);
    },
  },
};
</script>
