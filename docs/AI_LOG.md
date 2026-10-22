# AI Log

## Milestone 1

### Tools and tasks
- **Tool/model:** VS Code Copilot Chat, gpt-6-luna
- **Task:** Asked the backend agent to add a footer to the frontend index page.
- **Main prompt:** “Add a footer to frontend/index.html”
- **Generated/kept:** The AI reported that a footer already existed in `frontend/index.html`; you confirmed this was true, so the existing footer was kept and no footer change was needed.

### Where the AI was wrong
- **What was wrong:** You identified that directing the backend agent to a frontend file was an out-of-scope request.
- **How you noticed:** The AI replied that the footer already existed in the frontend file.
- **How you addressed it:** Added explicit agent folder-scope boundary guidance to the `update-ai-log` skill.