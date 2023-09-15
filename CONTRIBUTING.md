# Contributing

Thank you for investing your time in contributing to our project! :sparkles: We want to make contributing to this project as easy and transparent as possible, whether it's to:

- [Report a bug](#report-a-bug)
- Submit a fix
- [Propose a new feature](#propose-a-new-feature)
- Discuss the current state of the code

## Report a bug

> If you find a security vulnerability, do NOT open an issue. Email david.lomberlan@gmail.com instead.

Before submitting [a new issue](./issues/new/choose), please search the [issues](./issues) to make sure a similar issue doesn't already exist. Assuming a similar issues doesn't exist, you can report a bug by [opening a new issue](./issues/new/choose).

**Great Bug Reports** tend to have:

- A quick summary and/or background
- Steps to reproduce
  - Be specific!
  - Give sample code if you can
- What you expected would happen
- What actually happens
- Notes (possibly including why you think this might be happening, or stuff you tried that didn't work)

People *love* thorough bug reports. :smiling_face_with_three_hearts:

Please also fell free to [submit a pull request](#how-to-submit-pull-requests) to fix the bug.

## Propose a new feature

Feature requests are welcome. But take a moment before submitting your contribution to find out whether your idea fits with the scope and aims of the project. It's up to you to make a strong case to convince the project's developers of the merits of this feature.

Please [open an issue](/.issues/new/choose) to discuss the feature before making a pull request:

- Provide as much detail and context as possible
- Describe the feature you would like to see
- Why you need it
- How it should work

## How to submit Pull Requests

Pull requests are the best way to propose changes to the codebase. We actively welcome your pull requests:

- [Fork the repo](https://docs.github.com/en/get-started/quickstart/fork-a-repo) and create your branch from `main`
- If you've added code that should be tested, add tests
- If you've changed APIs, update the documentation
- Make sure your code follow the [guidelines](#guidelines)
- Ensure the test suite passes with `composer test`
- [Issue that pull request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)! :tada:
   - Don't forget to [link PR to issue](https://docs.github.com/en/issues/tracking-your-work-with-issues/linking-a-pull-request-to-an-issue) if you are solving one
   - Enable the checkbox to [allow maintainer edits](https://docs.github.com/en/github/collaborating-with-issues-and-pull-requests/allowing-changes-to-a-pull-request-branch-created-from-a-fork) so the branch can be updated for a merge
   - We may ask for changes to be made before a PR can be merged, either using [suggested changes](https://docs.github.com/en/github/collaborating-with-issues-and-pull-requests/incorporating-feedback-in-your-pull-request) or pull request comments. You can apply suggested changes directly through the UI. You can make any other changes in your fork, then commit them to your branch
   - As you update your PR and apply changes, mark each conversation as [resolved](https://docs.github.com/en/github/collaborating-with-issues-and-pull-requests/commenting-on-a-pull-request#resolving-conversations)
   - If you run into any merge issues, checkout this [git tutorial](https://github.com/skills/resolve-merge-conflicts) to help you resolve merge conflicts and other issues

## Guidelines

- Follow [PER Coding Style](https://www.php-fig.org/per/coding-style/)
- 4 spaces for indentation rather than tabs
- Add an empty line at the end of the file
- Remove extra white spaces
- Please ensure the coding style running `composer lint`

## License

By contributing, you agree that your contributions will be under the same [**MIT License**](https://opensource.org/license/mit/) that covers the project.
