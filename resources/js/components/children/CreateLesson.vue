<template>
  <div class="modal" id="createLesson" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" v-if="!editing">Create new Lesson</h5>
          <h5 class="modal-title" v-else>Update Lesson</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form submit.prevent method="post">
            <!-- <ul class="alert alert-danger">
              <li class="list-group-item"></li>
            </ul> -->
            <input
              type="text"
              class="form-control my-3"
              placeholder="Lesson title"
              v-model="lesson.title"
            />
            <input
              type="text"
              class="form-control my-3"
              placeholder="Vimeo video id"
              v-model="lesson.video_id"
            />
            <input
              type="number"
              class="form-control my-3"
              placeholder="Episode number"
              v-model="lesson.episode_number"
            />
            <textarea
              v-model="lesson.description"
              rows="4"
              class="form-control my-3"
            ></textarea>
            <button
              class="btn btn-primary w-100"
              @click.prevent="createLesson"
              v-if="!editing"
            >
              Save lesson
            </button>
            <button class="btn btn-primary w-100" @click.prevent="updateLesson" v-else>
              Update lesson
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
class Lesson {
  constructor(lesson) {
    this.title = lesson.title || "";
    this.description = lesson.description || "";
    this.video_id = lesson.video_id || "";
    this.episode_number = lesson.episode_number || "";
  }
}

import axios from "axios";
export default {
  created() {
    // Create mode
    this.emitter.on("create-mode", () => {
      this.editing = false;
      this.lesson = new Lesson({});
    });

    // Edit mode
    this.emitter.on("edit-mode", ({ lesson }) => {
      this.editing = true;
      this.lesson = new Lesson(lesson);
      this.lesson_id = lesson.id;
    });
  },
  props: ["seriesId"],
  emits: ["lesson_created", "lesson_updated"],
  data() {
    return {
      lesson_id: "",
      lesson: {},
      editing: false,
    };
  },
  methods: {
    createLesson() {
      axios
        .post(`/admin/${this.seriesId}/lessons`, this.lesson)
        .then((resp) => {
          this.$emit("lesson_created", resp.data);
          this.lesson = new Lesson({});
        })
        .catch((error) => {
          window.handleErrors(error);
        });
    },
    updateLesson() {
      axios
        .put(`/admin/${this.seriesId}/lessons/${this.lesson_id}`, this.lesson)
        .then((resp) => {
          $("#createLesson").modal("hide");
          this.$emit("lesson_updated", resp.data);
          window.noty({
            message: "Lesson updated successfully",
            type: "success",
          });
        })
        .catch((error) => {
          window.handleErrors(error);
        });
    },
  },
};
</script>
