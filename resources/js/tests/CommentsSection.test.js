import { expect, test } from 'vitest'
import { mount } from '@vue/test-utils'
import CommentForm from '../components/CommentForm.vue'

test('mount component', async () => {
    expect(CommentForm).toBeTruthy()

    const wrapper = mount(CommentForm)
    //
    expect(wrapper.text()).toContain('Post')
    expect(wrapper.html()).toMatchSnapshot()

})
