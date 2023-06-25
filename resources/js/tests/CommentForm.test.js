import { expect, test } from "vitest";
import CommentsSection from "../components/CommentsSection.vue";

test("mount component", async () => {
    expect(CommentsSection).toBeTruthy();
});
